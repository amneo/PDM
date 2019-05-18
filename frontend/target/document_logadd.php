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
$document_log_add = new document_log_add();

// Run the page
$document_log_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_log_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fdocument_logadd = currentForm = new ew.Form("fdocument_logadd", "add");

// Validate form
fdocument_logadd.validate = function() {
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
		<?php if ($document_log_add->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->firelink_doc_no->caption(), $document_log->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->client_doc_no->caption(), $document_log->client_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->order_number->Required) { ?>
			elm = this.getElements("x" + infix + "_order_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->order_number->caption(), $document_log->order_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->project_name->caption(), $document_log->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->document_tittle->caption(), $document_log->document_tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->current_status->Required) { ?>
			elm = this.getElements("x" + infix + "_current_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->current_status->caption(), $document_log->current_status->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->submit_no_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub1->caption(), $document_log->submit_no_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub1->caption(), $document_log->revision_no_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub1->caption(), $document_log->direction_out_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub1->caption(), $document_log->planned_date_out_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub1");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub1->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub1->caption(), $document_log->transmit_date_out_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub1");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub1->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub1->caption(), $document_log->transmit_no_out_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub1->caption(), $document_log->approval_status_out_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub1->caption(), $document_log->direction_in_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub1->caption(), $document_log->transmit_no_in_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub1->caption(), $document_log->approval_status_in_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub1->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub1->caption(), $document_log->transmit_date_in_sub1->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub1");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub1->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub2->caption(), $document_log->submit_no_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub2->caption(), $document_log->revision_no_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub2->caption(), $document_log->direction_out_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub2->caption(), $document_log->planned_date_out_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub2");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub2->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub2->caption(), $document_log->transmit_date_out_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub2");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub2->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub2->caption(), $document_log->transmit_no_out_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub2->caption(), $document_log->approval_status_out_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub2->caption(), $document_log->direction_in_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub2->caption(), $document_log->transmit_no_in_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub2->caption(), $document_log->approval_status_in_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub2->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub2->caption(), $document_log->transmit_date_in_sub2->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub2");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub2->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub3->caption(), $document_log->submit_no_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub3->caption(), $document_log->revision_no_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub3->caption(), $document_log->direction_out_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub3->caption(), $document_log->planned_date_out_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub3");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub3->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub3->caption(), $document_log->transmit_date_out_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub3");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub3->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub3->caption(), $document_log->transmit_no_out_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub3->caption(), $document_log->approval_status_out_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub3->caption(), $document_log->direction_in_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub3->caption(), $document_log->transmit_no_in_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub3->caption(), $document_log->approval_status_in_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub3->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub3->caption(), $document_log->transmit_date_in_sub3->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub3");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub3->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub4->caption(), $document_log->submit_no_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub4->caption(), $document_log->revision_no_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub4->caption(), $document_log->direction_out_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub4->caption(), $document_log->planned_date_out_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub4");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub4->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub4->caption(), $document_log->transmit_date_out_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub4");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub4->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub4->caption(), $document_log->transmit_no_out_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub4->caption(), $document_log->approval_status_out_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub4->caption(), $document_log->direction_in_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub4->caption(), $document_log->transmit_no_in_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub4->caption(), $document_log->approval_status_in_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_file_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_file_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_file_sub4->caption(), $document_log->direction_in_file_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub4->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub4->caption(), $document_log->transmit_date_in_sub4->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub4");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub4->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub5->caption(), $document_log->submit_no_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub5->caption(), $document_log->revision_no_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub5->caption(), $document_log->direction_out_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub5->caption(), $document_log->planned_date_out_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub5");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub5->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub5->caption(), $document_log->transmit_date_out_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub5");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub5->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub5->caption(), $document_log->transmit_no_out_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub5->caption(), $document_log->approval_status_out_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub5->caption(), $document_log->direction_in_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub5->caption(), $document_log->transmit_no_in_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub5->caption(), $document_log->approval_status_in_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_file_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_file_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_file_sub5->caption(), $document_log->direction_in_file_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub5->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub5->caption(), $document_log->transmit_date_in_sub5->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub5");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub5->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub6->caption(), $document_log->submit_no_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub6->caption(), $document_log->revision_no_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub6->caption(), $document_log->direction_out_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub6->caption(), $document_log->planned_date_out_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub6");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub6->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub6->caption(), $document_log->transmit_date_out_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub6");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub6->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub6->caption(), $document_log->transmit_no_out_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub6->caption(), $document_log->approval_status_out_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub6->caption(), $document_log->direction_in_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub6->caption(), $document_log->transmit_no_in_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub6->caption(), $document_log->approval_status_in_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_file_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_file_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_file_sub6->caption(), $document_log->direction_in_file_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub6->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub6->caption(), $document_log->transmit_date_in_sub6->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub6");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub6->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub7->caption(), $document_log->submit_no_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub7->caption(), $document_log->revision_no_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub7->caption(), $document_log->direction_out_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub7->caption(), $document_log->planned_date_out_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub7");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub7->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub7->caption(), $document_log->transmit_date_out_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub7");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub7->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub7->caption(), $document_log->transmit_no_out_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub7->caption(), $document_log->approval_status_out_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub7->caption(), $document_log->direction_in_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub7->caption(), $document_log->transmit_no_in_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub7->caption(), $document_log->approval_status_in_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub7->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub7->caption(), $document_log->transmit_date_in_sub7->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub7");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub7->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub8->caption(), $document_log->submit_no_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub8->caption(), $document_log->revision_no_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub8->caption(), $document_log->direction_out_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub8->caption(), $document_log->planned_date_out_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub8");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub8->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub8->caption(), $document_log->transmit_date_out_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub8");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub8->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub8->caption(), $document_log->transmit_no_out_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub8->caption(), $document_log->approval_status_out_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_file_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_file_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_file_sub8->caption(), $document_log->direction_out_file_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub8->caption(), $document_log->direction_in_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub8->caption(), $document_log->transmit_no_in_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub8->caption(), $document_log->approval_status_in_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub8->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub8->caption(), $document_log->transmit_date_in_sub8->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub8");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub8->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub9->caption(), $document_log->submit_no_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub9->caption(), $document_log->revision_no_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub9->caption(), $document_log->direction_out_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub9->caption(), $document_log->planned_date_out_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub9");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub9->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub9->caption(), $document_log->transmit_date_out_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub9");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub9->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub9->caption(), $document_log->transmit_no_out_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub9->caption(), $document_log->approval_status_out_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub9->caption(), $document_log->direction_in_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub9->caption(), $document_log->transmit_no_in_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub9->caption(), $document_log->approval_status_in_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub9->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub9->caption(), $document_log->transmit_date_in_sub9->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub9");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub9->errorMessage()) ?>");
		<?php if ($document_log_add->submit_no_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_sub10->caption(), $document_log->submit_no_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->revision_no_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_sub10->caption(), $document_log->revision_no_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_out_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_out_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_out_sub10->caption(), $document_log->direction_out_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->planned_date_out_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_out_sub10->caption(), $document_log->planned_date_out_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_out_sub10");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_out_sub10->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_date_out_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_out_sub10->caption(), $document_log->transmit_date_out_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_out_sub10");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_out_sub10->errorMessage()) ?>");
		<?php if ($document_log_add->transmit_no_out_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_out_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_out_sub10->caption(), $document_log->transmit_no_out_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_out_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_out_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_out_sub10->caption(), $document_log->approval_status_out_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->direction_in_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_in_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_in_sub10->caption(), $document_log->direction_in_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_no_in_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_in_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_in_sub10->caption(), $document_log->transmit_no_in_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->approval_status_in_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_in_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_in_sub10->caption(), $document_log->approval_status_in_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_add->transmit_date_in_sub10->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_in_sub10->caption(), $document_log->transmit_date_in_sub10->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_in_sub10");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_in_sub10->errorMessage()) ?>");

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
fdocument_logadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_logadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_log_add->showPageHeader(); ?>
<?php
$document_log_add->showMessage();
?>
<form name="fdocument_logadd" id="fdocument_logadd" class="<?php echo $document_log_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_log_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_log_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_log">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$document_log_add->IsModal ?>">
<?php if (!$document_log_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_logadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label id="elh_document_log_firelink_doc_no" for="x_firelink_doc_no" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->firelink_doc_no->caption() ?><?php echo ($document_log->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_log_firelink_doc_no">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_firelink_doc_no"><?php echo $document_log->firelink_doc_no->caption() ?><?php echo ($document_log->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_log_firelink_doc_no">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label id="elh_document_log_client_doc_no" for="x_client_doc_no" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->client_doc_no->caption() ?><?php echo ($document_log->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el_document_log_client_doc_no">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->client_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_client_doc_no"><?php echo $document_log->client_doc_no->caption() ?><?php echo ($document_log->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el_document_log_client_doc_no">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->client_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_order_number" class="form-group row">
		<label id="elh_document_log_order_number" for="x_order_number" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->order_number->caption() ?><?php echo ($document_log->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el_document_log_order_number">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
<?php echo $document_log->order_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_order_number">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_order_number"><?php echo $document_log->order_number->caption() ?><?php echo ($document_log->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el_document_log_order_number">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
<?php echo $document_log->order_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_document_log_project_name" for="x_project_name" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->project_name->caption() ?><?php echo ($document_log->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el_document_log_project_name">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
<?php echo $document_log->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_project_name"><?php echo $document_log->project_name->caption() ?><?php echo ($document_log->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el_document_log_project_name">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
<?php echo $document_log->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label id="elh_document_log_document_tittle" for="x_document_tittle" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->document_tittle->caption() ?><?php echo ($document_log->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el_document_log_document_tittle">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_log->document_tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_document_tittle"><?php echo $document_log->document_tittle->caption() ?><?php echo ($document_log->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el_document_log_document_tittle">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_log->document_tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_current_status" class="form-group row">
		<label id="elh_document_log_current_status" for="x_current_status" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->current_status->caption() ?><?php echo ($document_log->current_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el_document_log_current_status">
<input type="text" data-table="document_log" data-field="x_current_status" name="x_current_status" id="x_current_status" size="30" placeholder="<?php echo HtmlEncode($document_log->current_status->getPlaceHolder()) ?>" value="<?php echo $document_log->current_status->EditValue ?>"<?php echo $document_log->current_status->editAttributes() ?>>
</span>
<?php echo $document_log->current_status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_current_status">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_current_status"><?php echo $document_log->current_status->caption() ?><?php echo ($document_log->current_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el_document_log_current_status">
<input type="text" data-table="document_log" data-field="x_current_status" name="x_current_status" id="x_current_status" size="30" placeholder="<?php echo HtmlEncode($document_log->current_status->getPlaceHolder()) ?>" value="<?php echo $document_log->current_status->EditValue ?>"<?php echo $document_log->current_status->editAttributes() ?>>
</span>
<?php echo $document_log->current_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub1->Visible) { // submit_no_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub1" class="form-group row">
		<label id="elh_document_log_submit_no_sub1" for="x_submit_no_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub1->caption() ?><?php echo ($document_log->submit_no_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub1->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub1">
<input type="text" data-table="document_log" data-field="x_submit_no_sub1" name="x_submit_no_sub1" id="x_submit_no_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub1->EditValue ?>"<?php echo $document_log->submit_no_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub1"><?php echo $document_log->submit_no_sub1->caption() ?><?php echo ($document_log->submit_no_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub1->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub1">
<input type="text" data-table="document_log" data-field="x_submit_no_sub1" name="x_submit_no_sub1" id="x_submit_no_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub1->EditValue ?>"<?php echo $document_log->submit_no_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub1->Visible) { // revision_no_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub1" class="form-group row">
		<label id="elh_document_log_revision_no_sub1" for="x_revision_no_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub1->caption() ?><?php echo ($document_log->revision_no_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub1->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub1">
<input type="text" data-table="document_log" data-field="x_revision_no_sub1" name="x_revision_no_sub1" id="x_revision_no_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub1->EditValue ?>"<?php echo $document_log->revision_no_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub1"><?php echo $document_log->revision_no_sub1->caption() ?><?php echo ($document_log->revision_no_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub1->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub1">
<input type="text" data-table="document_log" data-field="x_revision_no_sub1" name="x_revision_no_sub1" id="x_revision_no_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub1->EditValue ?>"<?php echo $document_log->revision_no_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub1->Visible) { // direction_out_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub1" class="form-group row">
		<label id="elh_document_log_direction_out_sub1" for="x_direction_out_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub1->caption() ?><?php echo ($document_log->direction_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub1">
<input type="text" data-table="document_log" data-field="x_direction_out_sub1" name="x_direction_out_sub1" id="x_direction_out_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub1->EditValue ?>"<?php echo $document_log->direction_out_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub1"><?php echo $document_log->direction_out_sub1->caption() ?><?php echo ($document_log->direction_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub1">
<input type="text" data-table="document_log" data-field="x_direction_out_sub1" name="x_direction_out_sub1" id="x_direction_out_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub1->EditValue ?>"<?php echo $document_log->direction_out_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub1->Visible) { // planned_date_out_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub1" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub1" for="x_planned_date_out_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub1->caption() ?><?php echo ($document_log->planned_date_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub1->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub1">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub1" name="x_planned_date_out_sub1" id="x_planned_date_out_sub1" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub1->EditValue ?>"<?php echo $document_log->planned_date_out_sub1->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub1->ReadOnly && !$document_log->planned_date_out_sub1->Disabled && !isset($document_log->planned_date_out_sub1->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub1->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub1"><?php echo $document_log->planned_date_out_sub1->caption() ?><?php echo ($document_log->planned_date_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub1->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub1">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub1" name="x_planned_date_out_sub1" id="x_planned_date_out_sub1" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub1->EditValue ?>"<?php echo $document_log->planned_date_out_sub1->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub1->ReadOnly && !$document_log->planned_date_out_sub1->Disabled && !isset($document_log->planned_date_out_sub1->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub1->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub1->Visible) { // transmit_date_out_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub1" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub1" for="x_transmit_date_out_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub1->caption() ?><?php echo ($document_log->transmit_date_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub1" name="x_transmit_date_out_sub1" id="x_transmit_date_out_sub1" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub1->EditValue ?>"<?php echo $document_log->transmit_date_out_sub1->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub1->ReadOnly && !$document_log->transmit_date_out_sub1->Disabled && !isset($document_log->transmit_date_out_sub1->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub1->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub1"><?php echo $document_log->transmit_date_out_sub1->caption() ?><?php echo ($document_log->transmit_date_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub1" name="x_transmit_date_out_sub1" id="x_transmit_date_out_sub1" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub1->EditValue ?>"<?php echo $document_log->transmit_date_out_sub1->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub1->ReadOnly && !$document_log->transmit_date_out_sub1->Disabled && !isset($document_log->transmit_date_out_sub1->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub1->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub1->Visible) { // transmit_no_out_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub1" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub1" for="x_transmit_no_out_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub1->caption() ?><?php echo ($document_log->transmit_no_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub1" name="x_transmit_no_out_sub1" id="x_transmit_no_out_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub1->EditValue ?>"<?php echo $document_log->transmit_no_out_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub1"><?php echo $document_log->transmit_no_out_sub1->caption() ?><?php echo ($document_log->transmit_no_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub1" name="x_transmit_no_out_sub1" id="x_transmit_no_out_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub1->EditValue ?>"<?php echo $document_log->transmit_no_out_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub1->Visible) { // approval_status_out_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub1" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub1" for="x_approval_status_out_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub1->caption() ?><?php echo ($document_log->approval_status_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub1->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub1">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub1" name="x_approval_status_out_sub1" id="x_approval_status_out_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub1->EditValue ?>"<?php echo $document_log->approval_status_out_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub1"><?php echo $document_log->approval_status_out_sub1->caption() ?><?php echo ($document_log->approval_status_out_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub1->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub1">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub1" name="x_approval_status_out_sub1" id="x_approval_status_out_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub1->EditValue ?>"<?php echo $document_log->approval_status_out_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub1->Visible) { // direction_in_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub1" class="form-group row">
		<label id="elh_document_log_direction_in_sub1" for="x_direction_in_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub1->caption() ?><?php echo ($document_log->direction_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub1">
<input type="text" data-table="document_log" data-field="x_direction_in_sub1" name="x_direction_in_sub1" id="x_direction_in_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub1->EditValue ?>"<?php echo $document_log->direction_in_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub1"><?php echo $document_log->direction_in_sub1->caption() ?><?php echo ($document_log->direction_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub1">
<input type="text" data-table="document_log" data-field="x_direction_in_sub1" name="x_direction_in_sub1" id="x_direction_in_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub1->EditValue ?>"<?php echo $document_log->direction_in_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub1->Visible) { // transmit_no_in_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub1" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub1" for="x_transmit_no_in_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub1->caption() ?><?php echo ($document_log->transmit_no_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub1" name="x_transmit_no_in_sub1" id="x_transmit_no_in_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub1->EditValue ?>"<?php echo $document_log->transmit_no_in_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub1"><?php echo $document_log->transmit_no_in_sub1->caption() ?><?php echo ($document_log->transmit_no_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub1" name="x_transmit_no_in_sub1" id="x_transmit_no_in_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub1->EditValue ?>"<?php echo $document_log->transmit_no_in_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub1->Visible) { // approval_status_in_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub1" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub1" for="x_approval_status_in_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub1->caption() ?><?php echo ($document_log->approval_status_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub1->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub1">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub1" name="x_approval_status_in_sub1" id="x_approval_status_in_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub1->EditValue ?>"<?php echo $document_log->approval_status_in_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub1"><?php echo $document_log->approval_status_in_sub1->caption() ?><?php echo ($document_log->approval_status_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub1->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub1">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub1" name="x_approval_status_in_sub1" id="x_approval_status_in_sub1" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub1->EditValue ?>"<?php echo $document_log->approval_status_in_sub1->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub1->Visible) { // transmit_date_in_sub1 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub1" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub1" for="x_transmit_date_in_sub1" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub1->caption() ?><?php echo ($document_log->transmit_date_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub1" name="x_transmit_date_in_sub1" id="x_transmit_date_in_sub1" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub1->EditValue ?>"<?php echo $document_log->transmit_date_in_sub1->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub1->ReadOnly && !$document_log->transmit_date_in_sub1->Disabled && !isset($document_log->transmit_date_in_sub1->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub1->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub1">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub1"><?php echo $document_log->transmit_date_in_sub1->caption() ?><?php echo ($document_log->transmit_date_in_sub1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub1">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub1" name="x_transmit_date_in_sub1" id="x_transmit_date_in_sub1" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub1->EditValue ?>"<?php echo $document_log->transmit_date_in_sub1->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub1->ReadOnly && !$document_log->transmit_date_in_sub1->Disabled && !isset($document_log->transmit_date_in_sub1->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub1->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub2->Visible) { // submit_no_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub2" class="form-group row">
		<label id="elh_document_log_submit_no_sub2" for="x_submit_no_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub2->caption() ?><?php echo ($document_log->submit_no_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub2->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub2">
<input type="text" data-table="document_log" data-field="x_submit_no_sub2" name="x_submit_no_sub2" id="x_submit_no_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub2->EditValue ?>"<?php echo $document_log->submit_no_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub2"><?php echo $document_log->submit_no_sub2->caption() ?><?php echo ($document_log->submit_no_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub2->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub2">
<input type="text" data-table="document_log" data-field="x_submit_no_sub2" name="x_submit_no_sub2" id="x_submit_no_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub2->EditValue ?>"<?php echo $document_log->submit_no_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub2->Visible) { // revision_no_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub2" class="form-group row">
		<label id="elh_document_log_revision_no_sub2" for="x_revision_no_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub2->caption() ?><?php echo ($document_log->revision_no_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub2->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub2">
<input type="text" data-table="document_log" data-field="x_revision_no_sub2" name="x_revision_no_sub2" id="x_revision_no_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub2->EditValue ?>"<?php echo $document_log->revision_no_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub2"><?php echo $document_log->revision_no_sub2->caption() ?><?php echo ($document_log->revision_no_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub2->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub2">
<input type="text" data-table="document_log" data-field="x_revision_no_sub2" name="x_revision_no_sub2" id="x_revision_no_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub2->EditValue ?>"<?php echo $document_log->revision_no_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub2->Visible) { // direction_out_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub2" class="form-group row">
		<label id="elh_document_log_direction_out_sub2" for="x_direction_out_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub2->caption() ?><?php echo ($document_log->direction_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub2->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub2">
<input type="text" data-table="document_log" data-field="x_direction_out_sub2" name="x_direction_out_sub2" id="x_direction_out_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub2->EditValue ?>"<?php echo $document_log->direction_out_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub2"><?php echo $document_log->direction_out_sub2->caption() ?><?php echo ($document_log->direction_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub2->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub2">
<input type="text" data-table="document_log" data-field="x_direction_out_sub2" name="x_direction_out_sub2" id="x_direction_out_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub2->EditValue ?>"<?php echo $document_log->direction_out_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub2->Visible) { // planned_date_out_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub2" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub2" for="x_planned_date_out_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub2->caption() ?><?php echo ($document_log->planned_date_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub2->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub2">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub2" name="x_planned_date_out_sub2" id="x_planned_date_out_sub2" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub2->EditValue ?>"<?php echo $document_log->planned_date_out_sub2->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub2->ReadOnly && !$document_log->planned_date_out_sub2->Disabled && !isset($document_log->planned_date_out_sub2->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub2"><?php echo $document_log->planned_date_out_sub2->caption() ?><?php echo ($document_log->planned_date_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub2->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub2">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub2" name="x_planned_date_out_sub2" id="x_planned_date_out_sub2" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub2->EditValue ?>"<?php echo $document_log->planned_date_out_sub2->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub2->ReadOnly && !$document_log->planned_date_out_sub2->Disabled && !isset($document_log->planned_date_out_sub2->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub2->Visible) { // transmit_date_out_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub2" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub2" for="x_transmit_date_out_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub2->caption() ?><?php echo ($document_log->transmit_date_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub2" name="x_transmit_date_out_sub2" id="x_transmit_date_out_sub2" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub2->EditValue ?>"<?php echo $document_log->transmit_date_out_sub2->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub2->ReadOnly && !$document_log->transmit_date_out_sub2->Disabled && !isset($document_log->transmit_date_out_sub2->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub2"><?php echo $document_log->transmit_date_out_sub2->caption() ?><?php echo ($document_log->transmit_date_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub2" name="x_transmit_date_out_sub2" id="x_transmit_date_out_sub2" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub2->EditValue ?>"<?php echo $document_log->transmit_date_out_sub2->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub2->ReadOnly && !$document_log->transmit_date_out_sub2->Disabled && !isset($document_log->transmit_date_out_sub2->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub2->Visible) { // transmit_no_out_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub2" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub2" for="x_transmit_no_out_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub2->caption() ?><?php echo ($document_log->transmit_no_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub2" name="x_transmit_no_out_sub2" id="x_transmit_no_out_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub2->EditValue ?>"<?php echo $document_log->transmit_no_out_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub2"><?php echo $document_log->transmit_no_out_sub2->caption() ?><?php echo ($document_log->transmit_no_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub2" name="x_transmit_no_out_sub2" id="x_transmit_no_out_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub2->EditValue ?>"<?php echo $document_log->transmit_no_out_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub2->Visible) { // approval_status_out_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub2" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub2" for="x_approval_status_out_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub2->caption() ?><?php echo ($document_log->approval_status_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub2->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub2">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub2" name="x_approval_status_out_sub2" id="x_approval_status_out_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub2->EditValue ?>"<?php echo $document_log->approval_status_out_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub2"><?php echo $document_log->approval_status_out_sub2->caption() ?><?php echo ($document_log->approval_status_out_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub2->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub2">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub2" name="x_approval_status_out_sub2" id="x_approval_status_out_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub2->EditValue ?>"<?php echo $document_log->approval_status_out_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub2->Visible) { // direction_in_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub2" class="form-group row">
		<label id="elh_document_log_direction_in_sub2" for="x_direction_in_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub2->caption() ?><?php echo ($document_log->direction_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub2->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub2">
<input type="text" data-table="document_log" data-field="x_direction_in_sub2" name="x_direction_in_sub2" id="x_direction_in_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub2->EditValue ?>"<?php echo $document_log->direction_in_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub2"><?php echo $document_log->direction_in_sub2->caption() ?><?php echo ($document_log->direction_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub2->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub2">
<input type="text" data-table="document_log" data-field="x_direction_in_sub2" name="x_direction_in_sub2" id="x_direction_in_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub2->EditValue ?>"<?php echo $document_log->direction_in_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub2->Visible) { // transmit_no_in_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub2" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub2" for="x_transmit_no_in_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub2->caption() ?><?php echo ($document_log->transmit_no_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub2" name="x_transmit_no_in_sub2" id="x_transmit_no_in_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub2->EditValue ?>"<?php echo $document_log->transmit_no_in_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub2"><?php echo $document_log->transmit_no_in_sub2->caption() ?><?php echo ($document_log->transmit_no_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub2" name="x_transmit_no_in_sub2" id="x_transmit_no_in_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub2->EditValue ?>"<?php echo $document_log->transmit_no_in_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub2->Visible) { // approval_status_in_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub2" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub2" for="x_approval_status_in_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub2->caption() ?><?php echo ($document_log->approval_status_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub2->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub2">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub2" name="x_approval_status_in_sub2" id="x_approval_status_in_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub2->EditValue ?>"<?php echo $document_log->approval_status_in_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub2"><?php echo $document_log->approval_status_in_sub2->caption() ?><?php echo ($document_log->approval_status_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub2->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub2">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub2" name="x_approval_status_in_sub2" id="x_approval_status_in_sub2" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub2->EditValue ?>"<?php echo $document_log->approval_status_in_sub2->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub2->Visible) { // transmit_date_in_sub2 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub2" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub2" for="x_transmit_date_in_sub2" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub2->caption() ?><?php echo ($document_log->transmit_date_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub2" name="x_transmit_date_in_sub2" id="x_transmit_date_in_sub2" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub2->EditValue ?>"<?php echo $document_log->transmit_date_in_sub2->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub2->ReadOnly && !$document_log->transmit_date_in_sub2->Disabled && !isset($document_log->transmit_date_in_sub2->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub2">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub2"><?php echo $document_log->transmit_date_in_sub2->caption() ?><?php echo ($document_log->transmit_date_in_sub2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub2">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub2" name="x_transmit_date_in_sub2" id="x_transmit_date_in_sub2" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub2->EditValue ?>"<?php echo $document_log->transmit_date_in_sub2->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub2->ReadOnly && !$document_log->transmit_date_in_sub2->Disabled && !isset($document_log->transmit_date_in_sub2->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub3->Visible) { // submit_no_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub3" class="form-group row">
		<label id="elh_document_log_submit_no_sub3" for="x_submit_no_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub3->caption() ?><?php echo ($document_log->submit_no_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub3->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub3">
<input type="text" data-table="document_log" data-field="x_submit_no_sub3" name="x_submit_no_sub3" id="x_submit_no_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub3->EditValue ?>"<?php echo $document_log->submit_no_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub3"><?php echo $document_log->submit_no_sub3->caption() ?><?php echo ($document_log->submit_no_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub3->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub3">
<input type="text" data-table="document_log" data-field="x_submit_no_sub3" name="x_submit_no_sub3" id="x_submit_no_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub3->EditValue ?>"<?php echo $document_log->submit_no_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub3->Visible) { // revision_no_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub3" class="form-group row">
		<label id="elh_document_log_revision_no_sub3" for="x_revision_no_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub3->caption() ?><?php echo ($document_log->revision_no_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub3->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub3">
<input type="text" data-table="document_log" data-field="x_revision_no_sub3" name="x_revision_no_sub3" id="x_revision_no_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub3->EditValue ?>"<?php echo $document_log->revision_no_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub3"><?php echo $document_log->revision_no_sub3->caption() ?><?php echo ($document_log->revision_no_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub3->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub3">
<input type="text" data-table="document_log" data-field="x_revision_no_sub3" name="x_revision_no_sub3" id="x_revision_no_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub3->EditValue ?>"<?php echo $document_log->revision_no_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub3->Visible) { // direction_out_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub3" class="form-group row">
		<label id="elh_document_log_direction_out_sub3" for="x_direction_out_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub3->caption() ?><?php echo ($document_log->direction_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub3->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub3">
<input type="text" data-table="document_log" data-field="x_direction_out_sub3" name="x_direction_out_sub3" id="x_direction_out_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub3->EditValue ?>"<?php echo $document_log->direction_out_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub3"><?php echo $document_log->direction_out_sub3->caption() ?><?php echo ($document_log->direction_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub3->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub3">
<input type="text" data-table="document_log" data-field="x_direction_out_sub3" name="x_direction_out_sub3" id="x_direction_out_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub3->EditValue ?>"<?php echo $document_log->direction_out_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub3->Visible) { // planned_date_out_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub3" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub3" for="x_planned_date_out_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub3->caption() ?><?php echo ($document_log->planned_date_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub3->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub3">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub3" name="x_planned_date_out_sub3" id="x_planned_date_out_sub3" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub3->EditValue ?>"<?php echo $document_log->planned_date_out_sub3->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub3->ReadOnly && !$document_log->planned_date_out_sub3->Disabled && !isset($document_log->planned_date_out_sub3->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub3"><?php echo $document_log->planned_date_out_sub3->caption() ?><?php echo ($document_log->planned_date_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub3->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub3">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub3" name="x_planned_date_out_sub3" id="x_planned_date_out_sub3" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub3->EditValue ?>"<?php echo $document_log->planned_date_out_sub3->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub3->ReadOnly && !$document_log->planned_date_out_sub3->Disabled && !isset($document_log->planned_date_out_sub3->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub3->Visible) { // transmit_date_out_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub3" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub3" for="x_transmit_date_out_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub3->caption() ?><?php echo ($document_log->transmit_date_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub3" name="x_transmit_date_out_sub3" id="x_transmit_date_out_sub3" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub3->EditValue ?>"<?php echo $document_log->transmit_date_out_sub3->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub3->ReadOnly && !$document_log->transmit_date_out_sub3->Disabled && !isset($document_log->transmit_date_out_sub3->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub3"><?php echo $document_log->transmit_date_out_sub3->caption() ?><?php echo ($document_log->transmit_date_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub3" name="x_transmit_date_out_sub3" id="x_transmit_date_out_sub3" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub3->EditValue ?>"<?php echo $document_log->transmit_date_out_sub3->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub3->ReadOnly && !$document_log->transmit_date_out_sub3->Disabled && !isset($document_log->transmit_date_out_sub3->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub3->Visible) { // transmit_no_out_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub3" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub3" for="x_transmit_no_out_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub3->caption() ?><?php echo ($document_log->transmit_no_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub3" name="x_transmit_no_out_sub3" id="x_transmit_no_out_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub3->EditValue ?>"<?php echo $document_log->transmit_no_out_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub3"><?php echo $document_log->transmit_no_out_sub3->caption() ?><?php echo ($document_log->transmit_no_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub3" name="x_transmit_no_out_sub3" id="x_transmit_no_out_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub3->EditValue ?>"<?php echo $document_log->transmit_no_out_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub3->Visible) { // approval_status_out_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub3" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub3" for="x_approval_status_out_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub3->caption() ?><?php echo ($document_log->approval_status_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub3->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub3">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub3" name="x_approval_status_out_sub3" id="x_approval_status_out_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub3->EditValue ?>"<?php echo $document_log->approval_status_out_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub3"><?php echo $document_log->approval_status_out_sub3->caption() ?><?php echo ($document_log->approval_status_out_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub3->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub3">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub3" name="x_approval_status_out_sub3" id="x_approval_status_out_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub3->EditValue ?>"<?php echo $document_log->approval_status_out_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub3->Visible) { // direction_in_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub3" class="form-group row">
		<label id="elh_document_log_direction_in_sub3" for="x_direction_in_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub3->caption() ?><?php echo ($document_log->direction_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub3->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub3">
<input type="text" data-table="document_log" data-field="x_direction_in_sub3" name="x_direction_in_sub3" id="x_direction_in_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub3->EditValue ?>"<?php echo $document_log->direction_in_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub3"><?php echo $document_log->direction_in_sub3->caption() ?><?php echo ($document_log->direction_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub3->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub3">
<input type="text" data-table="document_log" data-field="x_direction_in_sub3" name="x_direction_in_sub3" id="x_direction_in_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub3->EditValue ?>"<?php echo $document_log->direction_in_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub3->Visible) { // transmit_no_in_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub3" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub3" for="x_transmit_no_in_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub3->caption() ?><?php echo ($document_log->transmit_no_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub3" name="x_transmit_no_in_sub3" id="x_transmit_no_in_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub3->EditValue ?>"<?php echo $document_log->transmit_no_in_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub3"><?php echo $document_log->transmit_no_in_sub3->caption() ?><?php echo ($document_log->transmit_no_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub3" name="x_transmit_no_in_sub3" id="x_transmit_no_in_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub3->EditValue ?>"<?php echo $document_log->transmit_no_in_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub3->Visible) { // approval_status_in_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub3" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub3" for="x_approval_status_in_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub3->caption() ?><?php echo ($document_log->approval_status_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub3->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub3">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub3" name="x_approval_status_in_sub3" id="x_approval_status_in_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub3->EditValue ?>"<?php echo $document_log->approval_status_in_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub3"><?php echo $document_log->approval_status_in_sub3->caption() ?><?php echo ($document_log->approval_status_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub3->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub3">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub3" name="x_approval_status_in_sub3" id="x_approval_status_in_sub3" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub3->EditValue ?>"<?php echo $document_log->approval_status_in_sub3->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub3->Visible) { // transmit_date_in_sub3 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub3" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub3" for="x_transmit_date_in_sub3" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub3->caption() ?><?php echo ($document_log->transmit_date_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub3" name="x_transmit_date_in_sub3" id="x_transmit_date_in_sub3" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub3->EditValue ?>"<?php echo $document_log->transmit_date_in_sub3->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub3->ReadOnly && !$document_log->transmit_date_in_sub3->Disabled && !isset($document_log->transmit_date_in_sub3->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub3">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub3"><?php echo $document_log->transmit_date_in_sub3->caption() ?><?php echo ($document_log->transmit_date_in_sub3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub3">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub3" name="x_transmit_date_in_sub3" id="x_transmit_date_in_sub3" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub3->EditValue ?>"<?php echo $document_log->transmit_date_in_sub3->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub3->ReadOnly && !$document_log->transmit_date_in_sub3->Disabled && !isset($document_log->transmit_date_in_sub3->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub4->Visible) { // submit_no_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub4" class="form-group row">
		<label id="elh_document_log_submit_no_sub4" for="x_submit_no_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub4->caption() ?><?php echo ($document_log->submit_no_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub4->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub4">
<input type="text" data-table="document_log" data-field="x_submit_no_sub4" name="x_submit_no_sub4" id="x_submit_no_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub4->EditValue ?>"<?php echo $document_log->submit_no_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub4"><?php echo $document_log->submit_no_sub4->caption() ?><?php echo ($document_log->submit_no_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub4->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub4">
<input type="text" data-table="document_log" data-field="x_submit_no_sub4" name="x_submit_no_sub4" id="x_submit_no_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub4->EditValue ?>"<?php echo $document_log->submit_no_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub4->Visible) { // revision_no_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub4" class="form-group row">
		<label id="elh_document_log_revision_no_sub4" for="x_revision_no_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub4->caption() ?><?php echo ($document_log->revision_no_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub4->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub4">
<input type="text" data-table="document_log" data-field="x_revision_no_sub4" name="x_revision_no_sub4" id="x_revision_no_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub4->EditValue ?>"<?php echo $document_log->revision_no_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub4"><?php echo $document_log->revision_no_sub4->caption() ?><?php echo ($document_log->revision_no_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub4->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub4">
<input type="text" data-table="document_log" data-field="x_revision_no_sub4" name="x_revision_no_sub4" id="x_revision_no_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub4->EditValue ?>"<?php echo $document_log->revision_no_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub4->Visible) { // direction_out_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub4" class="form-group row">
		<label id="elh_document_log_direction_out_sub4" for="x_direction_out_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub4->caption() ?><?php echo ($document_log->direction_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub4">
<input type="text" data-table="document_log" data-field="x_direction_out_sub4" name="x_direction_out_sub4" id="x_direction_out_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub4->EditValue ?>"<?php echo $document_log->direction_out_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub4"><?php echo $document_log->direction_out_sub4->caption() ?><?php echo ($document_log->direction_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub4">
<input type="text" data-table="document_log" data-field="x_direction_out_sub4" name="x_direction_out_sub4" id="x_direction_out_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub4->EditValue ?>"<?php echo $document_log->direction_out_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub4->Visible) { // planned_date_out_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub4" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub4" for="x_planned_date_out_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub4->caption() ?><?php echo ($document_log->planned_date_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub4->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub4">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub4" name="x_planned_date_out_sub4" id="x_planned_date_out_sub4" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub4->EditValue ?>"<?php echo $document_log->planned_date_out_sub4->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub4->ReadOnly && !$document_log->planned_date_out_sub4->Disabled && !isset($document_log->planned_date_out_sub4->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub4"><?php echo $document_log->planned_date_out_sub4->caption() ?><?php echo ($document_log->planned_date_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub4->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub4">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub4" name="x_planned_date_out_sub4" id="x_planned_date_out_sub4" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub4->EditValue ?>"<?php echo $document_log->planned_date_out_sub4->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub4->ReadOnly && !$document_log->planned_date_out_sub4->Disabled && !isset($document_log->planned_date_out_sub4->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub4->Visible) { // transmit_date_out_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub4" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub4" for="x_transmit_date_out_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub4->caption() ?><?php echo ($document_log->transmit_date_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub4" name="x_transmit_date_out_sub4" id="x_transmit_date_out_sub4" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub4->EditValue ?>"<?php echo $document_log->transmit_date_out_sub4->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub4->ReadOnly && !$document_log->transmit_date_out_sub4->Disabled && !isset($document_log->transmit_date_out_sub4->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub4"><?php echo $document_log->transmit_date_out_sub4->caption() ?><?php echo ($document_log->transmit_date_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub4" name="x_transmit_date_out_sub4" id="x_transmit_date_out_sub4" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub4->EditValue ?>"<?php echo $document_log->transmit_date_out_sub4->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub4->ReadOnly && !$document_log->transmit_date_out_sub4->Disabled && !isset($document_log->transmit_date_out_sub4->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub4->Visible) { // transmit_no_out_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub4" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub4" for="x_transmit_no_out_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub4->caption() ?><?php echo ($document_log->transmit_no_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub4" name="x_transmit_no_out_sub4" id="x_transmit_no_out_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub4->EditValue ?>"<?php echo $document_log->transmit_no_out_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub4"><?php echo $document_log->transmit_no_out_sub4->caption() ?><?php echo ($document_log->transmit_no_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub4" name="x_transmit_no_out_sub4" id="x_transmit_no_out_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub4->EditValue ?>"<?php echo $document_log->transmit_no_out_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub4->Visible) { // approval_status_out_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub4" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub4" for="x_approval_status_out_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub4->caption() ?><?php echo ($document_log->approval_status_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub4->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub4">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub4" name="x_approval_status_out_sub4" id="x_approval_status_out_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub4->EditValue ?>"<?php echo $document_log->approval_status_out_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub4"><?php echo $document_log->approval_status_out_sub4->caption() ?><?php echo ($document_log->approval_status_out_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub4->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub4">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub4" name="x_approval_status_out_sub4" id="x_approval_status_out_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub4->EditValue ?>"<?php echo $document_log->approval_status_out_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub4->Visible) { // direction_in_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub4" class="form-group row">
		<label id="elh_document_log_direction_in_sub4" for="x_direction_in_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub4->caption() ?><?php echo ($document_log->direction_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub4">
<input type="text" data-table="document_log" data-field="x_direction_in_sub4" name="x_direction_in_sub4" id="x_direction_in_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub4->EditValue ?>"<?php echo $document_log->direction_in_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub4"><?php echo $document_log->direction_in_sub4->caption() ?><?php echo ($document_log->direction_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub4">
<input type="text" data-table="document_log" data-field="x_direction_in_sub4" name="x_direction_in_sub4" id="x_direction_in_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub4->EditValue ?>"<?php echo $document_log->direction_in_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub4->Visible) { // transmit_no_in_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub4" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub4" for="x_transmit_no_in_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub4->caption() ?><?php echo ($document_log->transmit_no_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub4" name="x_transmit_no_in_sub4" id="x_transmit_no_in_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub4->EditValue ?>"<?php echo $document_log->transmit_no_in_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub4"><?php echo $document_log->transmit_no_in_sub4->caption() ?><?php echo ($document_log->transmit_no_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub4" name="x_transmit_no_in_sub4" id="x_transmit_no_in_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub4->EditValue ?>"<?php echo $document_log->transmit_no_in_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub4->Visible) { // approval_status_in_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub4" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub4" for="x_approval_status_in_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub4->caption() ?><?php echo ($document_log->approval_status_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub4->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub4">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub4" name="x_approval_status_in_sub4" id="x_approval_status_in_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub4->EditValue ?>"<?php echo $document_log->approval_status_in_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub4"><?php echo $document_log->approval_status_in_sub4->caption() ?><?php echo ($document_log->approval_status_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub4->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub4">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub4" name="x_approval_status_in_sub4" id="x_approval_status_in_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub4->EditValue ?>"<?php echo $document_log->approval_status_in_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_file_sub4->Visible) { // direction_in_file_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_file_sub4" class="form-group row">
		<label id="elh_document_log_direction_in_file_sub4" for="x_direction_in_file_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_file_sub4->caption() ?><?php echo ($document_log->direction_in_file_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_file_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub4">
<input type="text" data-table="document_log" data-field="x_direction_in_file_sub4" name="x_direction_in_file_sub4" id="x_direction_in_file_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_file_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_file_sub4->EditValue ?>"<?php echo $document_log->direction_in_file_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_file_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_file_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_file_sub4"><?php echo $document_log->direction_in_file_sub4->caption() ?><?php echo ($document_log->direction_in_file_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_file_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub4">
<input type="text" data-table="document_log" data-field="x_direction_in_file_sub4" name="x_direction_in_file_sub4" id="x_direction_in_file_sub4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_file_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_file_sub4->EditValue ?>"<?php echo $document_log->direction_in_file_sub4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_file_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub4->Visible) { // transmit_date_in_sub4 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub4" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub4" for="x_transmit_date_in_sub4" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub4->caption() ?><?php echo ($document_log->transmit_date_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub4" name="x_transmit_date_in_sub4" id="x_transmit_date_in_sub4" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub4->EditValue ?>"<?php echo $document_log->transmit_date_in_sub4->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub4->ReadOnly && !$document_log->transmit_date_in_sub4->Disabled && !isset($document_log->transmit_date_in_sub4->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub4">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub4"><?php echo $document_log->transmit_date_in_sub4->caption() ?><?php echo ($document_log->transmit_date_in_sub4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub4">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub4" name="x_transmit_date_in_sub4" id="x_transmit_date_in_sub4" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub4->EditValue ?>"<?php echo $document_log->transmit_date_in_sub4->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub4->ReadOnly && !$document_log->transmit_date_in_sub4->Disabled && !isset($document_log->transmit_date_in_sub4->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub5->Visible) { // submit_no_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub5" class="form-group row">
		<label id="elh_document_log_submit_no_sub5" for="x_submit_no_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub5->caption() ?><?php echo ($document_log->submit_no_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub5->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub5">
<input type="text" data-table="document_log" data-field="x_submit_no_sub5" name="x_submit_no_sub5" id="x_submit_no_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub5->EditValue ?>"<?php echo $document_log->submit_no_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub5"><?php echo $document_log->submit_no_sub5->caption() ?><?php echo ($document_log->submit_no_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub5->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub5">
<input type="text" data-table="document_log" data-field="x_submit_no_sub5" name="x_submit_no_sub5" id="x_submit_no_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub5->EditValue ?>"<?php echo $document_log->submit_no_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub5->Visible) { // revision_no_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub5" class="form-group row">
		<label id="elh_document_log_revision_no_sub5" for="x_revision_no_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub5->caption() ?><?php echo ($document_log->revision_no_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub5->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub5">
<input type="text" data-table="document_log" data-field="x_revision_no_sub5" name="x_revision_no_sub5" id="x_revision_no_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub5->EditValue ?>"<?php echo $document_log->revision_no_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub5"><?php echo $document_log->revision_no_sub5->caption() ?><?php echo ($document_log->revision_no_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub5->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub5">
<input type="text" data-table="document_log" data-field="x_revision_no_sub5" name="x_revision_no_sub5" id="x_revision_no_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub5->EditValue ?>"<?php echo $document_log->revision_no_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub5->Visible) { // direction_out_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub5" class="form-group row">
		<label id="elh_document_log_direction_out_sub5" for="x_direction_out_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub5->caption() ?><?php echo ($document_log->direction_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub5">
<input type="text" data-table="document_log" data-field="x_direction_out_sub5" name="x_direction_out_sub5" id="x_direction_out_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub5->EditValue ?>"<?php echo $document_log->direction_out_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub5"><?php echo $document_log->direction_out_sub5->caption() ?><?php echo ($document_log->direction_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub5">
<input type="text" data-table="document_log" data-field="x_direction_out_sub5" name="x_direction_out_sub5" id="x_direction_out_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub5->EditValue ?>"<?php echo $document_log->direction_out_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub5->Visible) { // planned_date_out_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub5" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub5" for="x_planned_date_out_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub5->caption() ?><?php echo ($document_log->planned_date_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub5->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub5">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub5" name="x_planned_date_out_sub5" id="x_planned_date_out_sub5" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub5->EditValue ?>"<?php echo $document_log->planned_date_out_sub5->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub5->ReadOnly && !$document_log->planned_date_out_sub5->Disabled && !isset($document_log->planned_date_out_sub5->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub5"><?php echo $document_log->planned_date_out_sub5->caption() ?><?php echo ($document_log->planned_date_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub5->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub5">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub5" name="x_planned_date_out_sub5" id="x_planned_date_out_sub5" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub5->EditValue ?>"<?php echo $document_log->planned_date_out_sub5->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub5->ReadOnly && !$document_log->planned_date_out_sub5->Disabled && !isset($document_log->planned_date_out_sub5->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub5->Visible) { // transmit_date_out_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub5" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub5" for="x_transmit_date_out_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub5->caption() ?><?php echo ($document_log->transmit_date_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub5" name="x_transmit_date_out_sub5" id="x_transmit_date_out_sub5" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub5->EditValue ?>"<?php echo $document_log->transmit_date_out_sub5->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub5->ReadOnly && !$document_log->transmit_date_out_sub5->Disabled && !isset($document_log->transmit_date_out_sub5->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub5"><?php echo $document_log->transmit_date_out_sub5->caption() ?><?php echo ($document_log->transmit_date_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub5" name="x_transmit_date_out_sub5" id="x_transmit_date_out_sub5" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub5->EditValue ?>"<?php echo $document_log->transmit_date_out_sub5->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub5->ReadOnly && !$document_log->transmit_date_out_sub5->Disabled && !isset($document_log->transmit_date_out_sub5->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub5->Visible) { // transmit_no_out_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub5" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub5" for="x_transmit_no_out_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub5->caption() ?><?php echo ($document_log->transmit_no_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub5" name="x_transmit_no_out_sub5" id="x_transmit_no_out_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub5->EditValue ?>"<?php echo $document_log->transmit_no_out_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub5"><?php echo $document_log->transmit_no_out_sub5->caption() ?><?php echo ($document_log->transmit_no_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub5" name="x_transmit_no_out_sub5" id="x_transmit_no_out_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub5->EditValue ?>"<?php echo $document_log->transmit_no_out_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub5->Visible) { // approval_status_out_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub5" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub5" for="x_approval_status_out_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub5->caption() ?><?php echo ($document_log->approval_status_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub5->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub5">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub5" name="x_approval_status_out_sub5" id="x_approval_status_out_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub5->EditValue ?>"<?php echo $document_log->approval_status_out_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub5"><?php echo $document_log->approval_status_out_sub5->caption() ?><?php echo ($document_log->approval_status_out_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub5->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub5">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub5" name="x_approval_status_out_sub5" id="x_approval_status_out_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub5->EditValue ?>"<?php echo $document_log->approval_status_out_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub5->Visible) { // direction_in_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub5" class="form-group row">
		<label id="elh_document_log_direction_in_sub5" for="x_direction_in_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub5->caption() ?><?php echo ($document_log->direction_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub5">
<input type="text" data-table="document_log" data-field="x_direction_in_sub5" name="x_direction_in_sub5" id="x_direction_in_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub5->EditValue ?>"<?php echo $document_log->direction_in_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub5"><?php echo $document_log->direction_in_sub5->caption() ?><?php echo ($document_log->direction_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub5">
<input type="text" data-table="document_log" data-field="x_direction_in_sub5" name="x_direction_in_sub5" id="x_direction_in_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub5->EditValue ?>"<?php echo $document_log->direction_in_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub5->Visible) { // transmit_no_in_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub5" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub5" for="x_transmit_no_in_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub5->caption() ?><?php echo ($document_log->transmit_no_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub5" name="x_transmit_no_in_sub5" id="x_transmit_no_in_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub5->EditValue ?>"<?php echo $document_log->transmit_no_in_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub5"><?php echo $document_log->transmit_no_in_sub5->caption() ?><?php echo ($document_log->transmit_no_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub5" name="x_transmit_no_in_sub5" id="x_transmit_no_in_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub5->EditValue ?>"<?php echo $document_log->transmit_no_in_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub5->Visible) { // approval_status_in_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub5" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub5" for="x_approval_status_in_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub5->caption() ?><?php echo ($document_log->approval_status_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub5->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub5">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub5" name="x_approval_status_in_sub5" id="x_approval_status_in_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub5->EditValue ?>"<?php echo $document_log->approval_status_in_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub5"><?php echo $document_log->approval_status_in_sub5->caption() ?><?php echo ($document_log->approval_status_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub5->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub5">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub5" name="x_approval_status_in_sub5" id="x_approval_status_in_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub5->EditValue ?>"<?php echo $document_log->approval_status_in_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_file_sub5->Visible) { // direction_in_file_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_file_sub5" class="form-group row">
		<label id="elh_document_log_direction_in_file_sub5" for="x_direction_in_file_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_file_sub5->caption() ?><?php echo ($document_log->direction_in_file_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_file_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub5">
<input type="text" data-table="document_log" data-field="x_direction_in_file_sub5" name="x_direction_in_file_sub5" id="x_direction_in_file_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_file_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_file_sub5->EditValue ?>"<?php echo $document_log->direction_in_file_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_file_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_file_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_file_sub5"><?php echo $document_log->direction_in_file_sub5->caption() ?><?php echo ($document_log->direction_in_file_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_file_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub5">
<input type="text" data-table="document_log" data-field="x_direction_in_file_sub5" name="x_direction_in_file_sub5" id="x_direction_in_file_sub5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_file_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_file_sub5->EditValue ?>"<?php echo $document_log->direction_in_file_sub5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_file_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub5->Visible) { // transmit_date_in_sub5 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub5" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub5" for="x_transmit_date_in_sub5" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub5->caption() ?><?php echo ($document_log->transmit_date_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub5" name="x_transmit_date_in_sub5" id="x_transmit_date_in_sub5" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub5->EditValue ?>"<?php echo $document_log->transmit_date_in_sub5->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub5->ReadOnly && !$document_log->transmit_date_in_sub5->Disabled && !isset($document_log->transmit_date_in_sub5->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub5">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub5"><?php echo $document_log->transmit_date_in_sub5->caption() ?><?php echo ($document_log->transmit_date_in_sub5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub5">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub5" name="x_transmit_date_in_sub5" id="x_transmit_date_in_sub5" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub5->EditValue ?>"<?php echo $document_log->transmit_date_in_sub5->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub5->ReadOnly && !$document_log->transmit_date_in_sub5->Disabled && !isset($document_log->transmit_date_in_sub5->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub6->Visible) { // submit_no_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub6" class="form-group row">
		<label id="elh_document_log_submit_no_sub6" for="x_submit_no_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub6->caption() ?><?php echo ($document_log->submit_no_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub6->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub6">
<input type="text" data-table="document_log" data-field="x_submit_no_sub6" name="x_submit_no_sub6" id="x_submit_no_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub6->EditValue ?>"<?php echo $document_log->submit_no_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub6"><?php echo $document_log->submit_no_sub6->caption() ?><?php echo ($document_log->submit_no_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub6->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub6">
<input type="text" data-table="document_log" data-field="x_submit_no_sub6" name="x_submit_no_sub6" id="x_submit_no_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub6->EditValue ?>"<?php echo $document_log->submit_no_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub6->Visible) { // revision_no_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub6" class="form-group row">
		<label id="elh_document_log_revision_no_sub6" for="x_revision_no_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub6->caption() ?><?php echo ($document_log->revision_no_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub6->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub6">
<input type="text" data-table="document_log" data-field="x_revision_no_sub6" name="x_revision_no_sub6" id="x_revision_no_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub6->EditValue ?>"<?php echo $document_log->revision_no_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub6"><?php echo $document_log->revision_no_sub6->caption() ?><?php echo ($document_log->revision_no_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub6->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub6">
<input type="text" data-table="document_log" data-field="x_revision_no_sub6" name="x_revision_no_sub6" id="x_revision_no_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub6->EditValue ?>"<?php echo $document_log->revision_no_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub6->Visible) { // direction_out_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub6" class="form-group row">
		<label id="elh_document_log_direction_out_sub6" for="x_direction_out_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub6->caption() ?><?php echo ($document_log->direction_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub6">
<input type="text" data-table="document_log" data-field="x_direction_out_sub6" name="x_direction_out_sub6" id="x_direction_out_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub6->EditValue ?>"<?php echo $document_log->direction_out_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub6"><?php echo $document_log->direction_out_sub6->caption() ?><?php echo ($document_log->direction_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub6">
<input type="text" data-table="document_log" data-field="x_direction_out_sub6" name="x_direction_out_sub6" id="x_direction_out_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub6->EditValue ?>"<?php echo $document_log->direction_out_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub6->Visible) { // planned_date_out_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub6" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub6" for="x_planned_date_out_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub6->caption() ?><?php echo ($document_log->planned_date_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub6->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub6">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub6" name="x_planned_date_out_sub6" id="x_planned_date_out_sub6" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub6->EditValue ?>"<?php echo $document_log->planned_date_out_sub6->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub6->ReadOnly && !$document_log->planned_date_out_sub6->Disabled && !isset($document_log->planned_date_out_sub6->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub6"><?php echo $document_log->planned_date_out_sub6->caption() ?><?php echo ($document_log->planned_date_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub6->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub6">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub6" name="x_planned_date_out_sub6" id="x_planned_date_out_sub6" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub6->EditValue ?>"<?php echo $document_log->planned_date_out_sub6->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub6->ReadOnly && !$document_log->planned_date_out_sub6->Disabled && !isset($document_log->planned_date_out_sub6->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub6->Visible) { // transmit_date_out_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub6" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub6" for="x_transmit_date_out_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub6->caption() ?><?php echo ($document_log->transmit_date_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub6" name="x_transmit_date_out_sub6" id="x_transmit_date_out_sub6" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub6->EditValue ?>"<?php echo $document_log->transmit_date_out_sub6->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub6->ReadOnly && !$document_log->transmit_date_out_sub6->Disabled && !isset($document_log->transmit_date_out_sub6->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub6"><?php echo $document_log->transmit_date_out_sub6->caption() ?><?php echo ($document_log->transmit_date_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub6" name="x_transmit_date_out_sub6" id="x_transmit_date_out_sub6" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub6->EditValue ?>"<?php echo $document_log->transmit_date_out_sub6->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub6->ReadOnly && !$document_log->transmit_date_out_sub6->Disabled && !isset($document_log->transmit_date_out_sub6->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub6->Visible) { // transmit_no_out_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub6" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub6" for="x_transmit_no_out_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub6->caption() ?><?php echo ($document_log->transmit_no_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub6" name="x_transmit_no_out_sub6" id="x_transmit_no_out_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub6->EditValue ?>"<?php echo $document_log->transmit_no_out_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub6"><?php echo $document_log->transmit_no_out_sub6->caption() ?><?php echo ($document_log->transmit_no_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub6" name="x_transmit_no_out_sub6" id="x_transmit_no_out_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub6->EditValue ?>"<?php echo $document_log->transmit_no_out_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub6->Visible) { // approval_status_out_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub6" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub6" for="x_approval_status_out_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub6->caption() ?><?php echo ($document_log->approval_status_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub6->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub6">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub6" name="x_approval_status_out_sub6" id="x_approval_status_out_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub6->EditValue ?>"<?php echo $document_log->approval_status_out_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub6"><?php echo $document_log->approval_status_out_sub6->caption() ?><?php echo ($document_log->approval_status_out_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub6->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub6">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub6" name="x_approval_status_out_sub6" id="x_approval_status_out_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub6->EditValue ?>"<?php echo $document_log->approval_status_out_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub6->Visible) { // direction_in_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub6" class="form-group row">
		<label id="elh_document_log_direction_in_sub6" for="x_direction_in_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub6->caption() ?><?php echo ($document_log->direction_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub6">
<input type="text" data-table="document_log" data-field="x_direction_in_sub6" name="x_direction_in_sub6" id="x_direction_in_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub6->EditValue ?>"<?php echo $document_log->direction_in_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub6"><?php echo $document_log->direction_in_sub6->caption() ?><?php echo ($document_log->direction_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub6">
<input type="text" data-table="document_log" data-field="x_direction_in_sub6" name="x_direction_in_sub6" id="x_direction_in_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub6->EditValue ?>"<?php echo $document_log->direction_in_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub6->Visible) { // transmit_no_in_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub6" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub6" for="x_transmit_no_in_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub6->caption() ?><?php echo ($document_log->transmit_no_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub6" name="x_transmit_no_in_sub6" id="x_transmit_no_in_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub6->EditValue ?>"<?php echo $document_log->transmit_no_in_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub6"><?php echo $document_log->transmit_no_in_sub6->caption() ?><?php echo ($document_log->transmit_no_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub6" name="x_transmit_no_in_sub6" id="x_transmit_no_in_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub6->EditValue ?>"<?php echo $document_log->transmit_no_in_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub6->Visible) { // approval_status_in_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub6" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub6" for="x_approval_status_in_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub6->caption() ?><?php echo ($document_log->approval_status_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub6->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub6">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub6" name="x_approval_status_in_sub6" id="x_approval_status_in_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub6->EditValue ?>"<?php echo $document_log->approval_status_in_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub6"><?php echo $document_log->approval_status_in_sub6->caption() ?><?php echo ($document_log->approval_status_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub6->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub6">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub6" name="x_approval_status_in_sub6" id="x_approval_status_in_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub6->EditValue ?>"<?php echo $document_log->approval_status_in_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_file_sub6->Visible) { // direction_in_file_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_file_sub6" class="form-group row">
		<label id="elh_document_log_direction_in_file_sub6" for="x_direction_in_file_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_file_sub6->caption() ?><?php echo ($document_log->direction_in_file_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_file_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub6">
<input type="text" data-table="document_log" data-field="x_direction_in_file_sub6" name="x_direction_in_file_sub6" id="x_direction_in_file_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_file_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_file_sub6->EditValue ?>"<?php echo $document_log->direction_in_file_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_file_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_file_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_file_sub6"><?php echo $document_log->direction_in_file_sub6->caption() ?><?php echo ($document_log->direction_in_file_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_file_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub6">
<input type="text" data-table="document_log" data-field="x_direction_in_file_sub6" name="x_direction_in_file_sub6" id="x_direction_in_file_sub6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_file_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_file_sub6->EditValue ?>"<?php echo $document_log->direction_in_file_sub6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_file_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub6->Visible) { // transmit_date_in_sub6 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub6" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub6" for="x_transmit_date_in_sub6" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub6->caption() ?><?php echo ($document_log->transmit_date_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub6" name="x_transmit_date_in_sub6" id="x_transmit_date_in_sub6" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub6->EditValue ?>"<?php echo $document_log->transmit_date_in_sub6->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub6->ReadOnly && !$document_log->transmit_date_in_sub6->Disabled && !isset($document_log->transmit_date_in_sub6->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub6">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub6"><?php echo $document_log->transmit_date_in_sub6->caption() ?><?php echo ($document_log->transmit_date_in_sub6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub6">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub6" name="x_transmit_date_in_sub6" id="x_transmit_date_in_sub6" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub6->EditValue ?>"<?php echo $document_log->transmit_date_in_sub6->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub6->ReadOnly && !$document_log->transmit_date_in_sub6->Disabled && !isset($document_log->transmit_date_in_sub6->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub7->Visible) { // submit_no_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub7" class="form-group row">
		<label id="elh_document_log_submit_no_sub7" for="x_submit_no_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub7->caption() ?><?php echo ($document_log->submit_no_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub7->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub7">
<input type="text" data-table="document_log" data-field="x_submit_no_sub7" name="x_submit_no_sub7" id="x_submit_no_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub7->EditValue ?>"<?php echo $document_log->submit_no_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub7"><?php echo $document_log->submit_no_sub7->caption() ?><?php echo ($document_log->submit_no_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub7->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub7">
<input type="text" data-table="document_log" data-field="x_submit_no_sub7" name="x_submit_no_sub7" id="x_submit_no_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub7->EditValue ?>"<?php echo $document_log->submit_no_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub7->Visible) { // revision_no_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub7" class="form-group row">
		<label id="elh_document_log_revision_no_sub7" for="x_revision_no_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub7->caption() ?><?php echo ($document_log->revision_no_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub7->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub7">
<input type="text" data-table="document_log" data-field="x_revision_no_sub7" name="x_revision_no_sub7" id="x_revision_no_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub7->EditValue ?>"<?php echo $document_log->revision_no_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub7"><?php echo $document_log->revision_no_sub7->caption() ?><?php echo ($document_log->revision_no_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub7->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub7">
<input type="text" data-table="document_log" data-field="x_revision_no_sub7" name="x_revision_no_sub7" id="x_revision_no_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub7->EditValue ?>"<?php echo $document_log->revision_no_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub7->Visible) { // direction_out_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub7" class="form-group row">
		<label id="elh_document_log_direction_out_sub7" for="x_direction_out_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub7->caption() ?><?php echo ($document_log->direction_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub7->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub7">
<input type="text" data-table="document_log" data-field="x_direction_out_sub7" name="x_direction_out_sub7" id="x_direction_out_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub7->EditValue ?>"<?php echo $document_log->direction_out_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub7"><?php echo $document_log->direction_out_sub7->caption() ?><?php echo ($document_log->direction_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub7->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub7">
<input type="text" data-table="document_log" data-field="x_direction_out_sub7" name="x_direction_out_sub7" id="x_direction_out_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub7->EditValue ?>"<?php echo $document_log->direction_out_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub7->Visible) { // planned_date_out_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub7" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub7" for="x_planned_date_out_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub7->caption() ?><?php echo ($document_log->planned_date_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub7->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub7">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub7" name="x_planned_date_out_sub7" id="x_planned_date_out_sub7" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub7->EditValue ?>"<?php echo $document_log->planned_date_out_sub7->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub7->ReadOnly && !$document_log->planned_date_out_sub7->Disabled && !isset($document_log->planned_date_out_sub7->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub7"><?php echo $document_log->planned_date_out_sub7->caption() ?><?php echo ($document_log->planned_date_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub7->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub7">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub7" name="x_planned_date_out_sub7" id="x_planned_date_out_sub7" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub7->EditValue ?>"<?php echo $document_log->planned_date_out_sub7->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub7->ReadOnly && !$document_log->planned_date_out_sub7->Disabled && !isset($document_log->planned_date_out_sub7->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub7->Visible) { // transmit_date_out_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub7" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub7" for="x_transmit_date_out_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub7->caption() ?><?php echo ($document_log->transmit_date_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub7" name="x_transmit_date_out_sub7" id="x_transmit_date_out_sub7" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub7->EditValue ?>"<?php echo $document_log->transmit_date_out_sub7->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub7->ReadOnly && !$document_log->transmit_date_out_sub7->Disabled && !isset($document_log->transmit_date_out_sub7->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub7"><?php echo $document_log->transmit_date_out_sub7->caption() ?><?php echo ($document_log->transmit_date_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub7" name="x_transmit_date_out_sub7" id="x_transmit_date_out_sub7" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub7->EditValue ?>"<?php echo $document_log->transmit_date_out_sub7->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub7->ReadOnly && !$document_log->transmit_date_out_sub7->Disabled && !isset($document_log->transmit_date_out_sub7->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub7->Visible) { // transmit_no_out_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub7" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub7" for="x_transmit_no_out_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub7->caption() ?><?php echo ($document_log->transmit_no_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub7" name="x_transmit_no_out_sub7" id="x_transmit_no_out_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub7->EditValue ?>"<?php echo $document_log->transmit_no_out_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub7"><?php echo $document_log->transmit_no_out_sub7->caption() ?><?php echo ($document_log->transmit_no_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub7" name="x_transmit_no_out_sub7" id="x_transmit_no_out_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub7->EditValue ?>"<?php echo $document_log->transmit_no_out_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub7->Visible) { // approval_status_out_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub7" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub7" for="x_approval_status_out_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub7->caption() ?><?php echo ($document_log->approval_status_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub7->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub7">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub7" name="x_approval_status_out_sub7" id="x_approval_status_out_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub7->EditValue ?>"<?php echo $document_log->approval_status_out_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub7"><?php echo $document_log->approval_status_out_sub7->caption() ?><?php echo ($document_log->approval_status_out_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub7->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub7">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub7" name="x_approval_status_out_sub7" id="x_approval_status_out_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub7->EditValue ?>"<?php echo $document_log->approval_status_out_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub7->Visible) { // direction_in_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub7" class="form-group row">
		<label id="elh_document_log_direction_in_sub7" for="x_direction_in_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub7->caption() ?><?php echo ($document_log->direction_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub7->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub7">
<input type="text" data-table="document_log" data-field="x_direction_in_sub7" name="x_direction_in_sub7" id="x_direction_in_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub7->EditValue ?>"<?php echo $document_log->direction_in_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub7"><?php echo $document_log->direction_in_sub7->caption() ?><?php echo ($document_log->direction_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub7->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub7">
<input type="text" data-table="document_log" data-field="x_direction_in_sub7" name="x_direction_in_sub7" id="x_direction_in_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub7->EditValue ?>"<?php echo $document_log->direction_in_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub7->Visible) { // transmit_no_in_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub7" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub7" for="x_transmit_no_in_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub7->caption() ?><?php echo ($document_log->transmit_no_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub7" name="x_transmit_no_in_sub7" id="x_transmit_no_in_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub7->EditValue ?>"<?php echo $document_log->transmit_no_in_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub7"><?php echo $document_log->transmit_no_in_sub7->caption() ?><?php echo ($document_log->transmit_no_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub7" name="x_transmit_no_in_sub7" id="x_transmit_no_in_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub7->EditValue ?>"<?php echo $document_log->transmit_no_in_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub7->Visible) { // approval_status_in_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub7" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub7" for="x_approval_status_in_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub7->caption() ?><?php echo ($document_log->approval_status_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub7->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub7">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub7" name="x_approval_status_in_sub7" id="x_approval_status_in_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub7->EditValue ?>"<?php echo $document_log->approval_status_in_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub7"><?php echo $document_log->approval_status_in_sub7->caption() ?><?php echo ($document_log->approval_status_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub7->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub7">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub7" name="x_approval_status_in_sub7" id="x_approval_status_in_sub7" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub7->EditValue ?>"<?php echo $document_log->approval_status_in_sub7->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub7->Visible) { // transmit_date_in_sub7 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub7" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub7" for="x_transmit_date_in_sub7" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub7->caption() ?><?php echo ($document_log->transmit_date_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub7" name="x_transmit_date_in_sub7" id="x_transmit_date_in_sub7" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub7->EditValue ?>"<?php echo $document_log->transmit_date_in_sub7->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub7->ReadOnly && !$document_log->transmit_date_in_sub7->Disabled && !isset($document_log->transmit_date_in_sub7->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub7">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub7"><?php echo $document_log->transmit_date_in_sub7->caption() ?><?php echo ($document_log->transmit_date_in_sub7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub7">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub7" name="x_transmit_date_in_sub7" id="x_transmit_date_in_sub7" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub7->EditValue ?>"<?php echo $document_log->transmit_date_in_sub7->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub7->ReadOnly && !$document_log->transmit_date_in_sub7->Disabled && !isset($document_log->transmit_date_in_sub7->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub8->Visible) { // submit_no_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub8" class="form-group row">
		<label id="elh_document_log_submit_no_sub8" for="x_submit_no_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub8->caption() ?><?php echo ($document_log->submit_no_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub8->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub8">
<input type="text" data-table="document_log" data-field="x_submit_no_sub8" name="x_submit_no_sub8" id="x_submit_no_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub8->EditValue ?>"<?php echo $document_log->submit_no_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub8"><?php echo $document_log->submit_no_sub8->caption() ?><?php echo ($document_log->submit_no_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub8->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub8">
<input type="text" data-table="document_log" data-field="x_submit_no_sub8" name="x_submit_no_sub8" id="x_submit_no_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub8->EditValue ?>"<?php echo $document_log->submit_no_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub8->Visible) { // revision_no_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub8" class="form-group row">
		<label id="elh_document_log_revision_no_sub8" for="x_revision_no_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub8->caption() ?><?php echo ($document_log->revision_no_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub8->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub8">
<input type="text" data-table="document_log" data-field="x_revision_no_sub8" name="x_revision_no_sub8" id="x_revision_no_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub8->EditValue ?>"<?php echo $document_log->revision_no_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub8"><?php echo $document_log->revision_no_sub8->caption() ?><?php echo ($document_log->revision_no_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub8->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub8">
<input type="text" data-table="document_log" data-field="x_revision_no_sub8" name="x_revision_no_sub8" id="x_revision_no_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub8->EditValue ?>"<?php echo $document_log->revision_no_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub8->Visible) { // direction_out_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub8" class="form-group row">
		<label id="elh_document_log_direction_out_sub8" for="x_direction_out_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub8->caption() ?><?php echo ($document_log->direction_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub8">
<input type="text" data-table="document_log" data-field="x_direction_out_sub8" name="x_direction_out_sub8" id="x_direction_out_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub8->EditValue ?>"<?php echo $document_log->direction_out_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub8"><?php echo $document_log->direction_out_sub8->caption() ?><?php echo ($document_log->direction_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub8">
<input type="text" data-table="document_log" data-field="x_direction_out_sub8" name="x_direction_out_sub8" id="x_direction_out_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub8->EditValue ?>"<?php echo $document_log->direction_out_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub8->Visible) { // planned_date_out_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub8" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub8" for="x_planned_date_out_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub8->caption() ?><?php echo ($document_log->planned_date_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub8->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub8">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub8" name="x_planned_date_out_sub8" id="x_planned_date_out_sub8" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub8->EditValue ?>"<?php echo $document_log->planned_date_out_sub8->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub8->ReadOnly && !$document_log->planned_date_out_sub8->Disabled && !isset($document_log->planned_date_out_sub8->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub8"><?php echo $document_log->planned_date_out_sub8->caption() ?><?php echo ($document_log->planned_date_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub8->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub8">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub8" name="x_planned_date_out_sub8" id="x_planned_date_out_sub8" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub8->EditValue ?>"<?php echo $document_log->planned_date_out_sub8->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub8->ReadOnly && !$document_log->planned_date_out_sub8->Disabled && !isset($document_log->planned_date_out_sub8->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub8->Visible) { // transmit_date_out_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub8" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub8" for="x_transmit_date_out_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub8->caption() ?><?php echo ($document_log->transmit_date_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub8" name="x_transmit_date_out_sub8" id="x_transmit_date_out_sub8" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub8->EditValue ?>"<?php echo $document_log->transmit_date_out_sub8->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub8->ReadOnly && !$document_log->transmit_date_out_sub8->Disabled && !isset($document_log->transmit_date_out_sub8->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub8"><?php echo $document_log->transmit_date_out_sub8->caption() ?><?php echo ($document_log->transmit_date_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub8" name="x_transmit_date_out_sub8" id="x_transmit_date_out_sub8" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub8->EditValue ?>"<?php echo $document_log->transmit_date_out_sub8->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub8->ReadOnly && !$document_log->transmit_date_out_sub8->Disabled && !isset($document_log->transmit_date_out_sub8->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub8->Visible) { // transmit_no_out_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub8" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub8" for="x_transmit_no_out_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub8->caption() ?><?php echo ($document_log->transmit_no_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub8" name="x_transmit_no_out_sub8" id="x_transmit_no_out_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub8->EditValue ?>"<?php echo $document_log->transmit_no_out_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub8"><?php echo $document_log->transmit_no_out_sub8->caption() ?><?php echo ($document_log->transmit_no_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub8" name="x_transmit_no_out_sub8" id="x_transmit_no_out_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub8->EditValue ?>"<?php echo $document_log->transmit_no_out_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub8->Visible) { // approval_status_out_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub8" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub8" for="x_approval_status_out_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub8->caption() ?><?php echo ($document_log->approval_status_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub8->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub8">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub8" name="x_approval_status_out_sub8" id="x_approval_status_out_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub8->EditValue ?>"<?php echo $document_log->approval_status_out_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub8"><?php echo $document_log->approval_status_out_sub8->caption() ?><?php echo ($document_log->approval_status_out_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub8->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub8">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub8" name="x_approval_status_out_sub8" id="x_approval_status_out_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub8->EditValue ?>"<?php echo $document_log->approval_status_out_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_file_sub8->Visible) { // direction_out_file_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_file_sub8" class="form-group row">
		<label id="elh_document_log_direction_out_file_sub8" for="x_direction_out_file_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_file_sub8->caption() ?><?php echo ($document_log->direction_out_file_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_file_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_out_file_sub8">
<input type="text" data-table="document_log" data-field="x_direction_out_file_sub8" name="x_direction_out_file_sub8" id="x_direction_out_file_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_file_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_file_sub8->EditValue ?>"<?php echo $document_log->direction_out_file_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_file_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_file_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_file_sub8"><?php echo $document_log->direction_out_file_sub8->caption() ?><?php echo ($document_log->direction_out_file_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_file_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_out_file_sub8">
<input type="text" data-table="document_log" data-field="x_direction_out_file_sub8" name="x_direction_out_file_sub8" id="x_direction_out_file_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_file_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_file_sub8->EditValue ?>"<?php echo $document_log->direction_out_file_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_file_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub8->Visible) { // direction_in_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub8" class="form-group row">
		<label id="elh_document_log_direction_in_sub8" for="x_direction_in_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub8->caption() ?><?php echo ($document_log->direction_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub8">
<input type="text" data-table="document_log" data-field="x_direction_in_sub8" name="x_direction_in_sub8" id="x_direction_in_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub8->EditValue ?>"<?php echo $document_log->direction_in_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub8"><?php echo $document_log->direction_in_sub8->caption() ?><?php echo ($document_log->direction_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub8">
<input type="text" data-table="document_log" data-field="x_direction_in_sub8" name="x_direction_in_sub8" id="x_direction_in_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub8->EditValue ?>"<?php echo $document_log->direction_in_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub8->Visible) { // transmit_no_in_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub8" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub8" for="x_transmit_no_in_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub8->caption() ?><?php echo ($document_log->transmit_no_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub8" name="x_transmit_no_in_sub8" id="x_transmit_no_in_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub8->EditValue ?>"<?php echo $document_log->transmit_no_in_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub8"><?php echo $document_log->transmit_no_in_sub8->caption() ?><?php echo ($document_log->transmit_no_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub8" name="x_transmit_no_in_sub8" id="x_transmit_no_in_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub8->EditValue ?>"<?php echo $document_log->transmit_no_in_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub8->Visible) { // approval_status_in_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub8" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub8" for="x_approval_status_in_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub8->caption() ?><?php echo ($document_log->approval_status_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub8->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub8">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub8" name="x_approval_status_in_sub8" id="x_approval_status_in_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub8->EditValue ?>"<?php echo $document_log->approval_status_in_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub8"><?php echo $document_log->approval_status_in_sub8->caption() ?><?php echo ($document_log->approval_status_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub8->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub8">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub8" name="x_approval_status_in_sub8" id="x_approval_status_in_sub8" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub8->EditValue ?>"<?php echo $document_log->approval_status_in_sub8->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub8->Visible) { // transmit_date_in_sub8 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub8" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub8" for="x_transmit_date_in_sub8" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub8->caption() ?><?php echo ($document_log->transmit_date_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub8" name="x_transmit_date_in_sub8" id="x_transmit_date_in_sub8" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub8->EditValue ?>"<?php echo $document_log->transmit_date_in_sub8->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub8->ReadOnly && !$document_log->transmit_date_in_sub8->Disabled && !isset($document_log->transmit_date_in_sub8->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub8">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub8"><?php echo $document_log->transmit_date_in_sub8->caption() ?><?php echo ($document_log->transmit_date_in_sub8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub8">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub8" name="x_transmit_date_in_sub8" id="x_transmit_date_in_sub8" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub8->EditValue ?>"<?php echo $document_log->transmit_date_in_sub8->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub8->ReadOnly && !$document_log->transmit_date_in_sub8->Disabled && !isset($document_log->transmit_date_in_sub8->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub9->Visible) { // submit_no_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub9" class="form-group row">
		<label id="elh_document_log_submit_no_sub9" for="x_submit_no_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub9->caption() ?><?php echo ($document_log->submit_no_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub9->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub9">
<input type="text" data-table="document_log" data-field="x_submit_no_sub9" name="x_submit_no_sub9" id="x_submit_no_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub9->EditValue ?>"<?php echo $document_log->submit_no_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub9"><?php echo $document_log->submit_no_sub9->caption() ?><?php echo ($document_log->submit_no_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub9->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub9">
<input type="text" data-table="document_log" data-field="x_submit_no_sub9" name="x_submit_no_sub9" id="x_submit_no_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub9->EditValue ?>"<?php echo $document_log->submit_no_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub9->Visible) { // revision_no_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub9" class="form-group row">
		<label id="elh_document_log_revision_no_sub9" for="x_revision_no_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub9->caption() ?><?php echo ($document_log->revision_no_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub9->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub9">
<input type="text" data-table="document_log" data-field="x_revision_no_sub9" name="x_revision_no_sub9" id="x_revision_no_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub9->EditValue ?>"<?php echo $document_log->revision_no_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub9"><?php echo $document_log->revision_no_sub9->caption() ?><?php echo ($document_log->revision_no_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub9->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub9">
<input type="text" data-table="document_log" data-field="x_revision_no_sub9" name="x_revision_no_sub9" id="x_revision_no_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub9->EditValue ?>"<?php echo $document_log->revision_no_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub9->Visible) { // direction_out_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub9" class="form-group row">
		<label id="elh_document_log_direction_out_sub9" for="x_direction_out_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub9->caption() ?><?php echo ($document_log->direction_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub9->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub9">
<input type="text" data-table="document_log" data-field="x_direction_out_sub9" name="x_direction_out_sub9" id="x_direction_out_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub9->EditValue ?>"<?php echo $document_log->direction_out_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub9"><?php echo $document_log->direction_out_sub9->caption() ?><?php echo ($document_log->direction_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub9->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub9">
<input type="text" data-table="document_log" data-field="x_direction_out_sub9" name="x_direction_out_sub9" id="x_direction_out_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub9->EditValue ?>"<?php echo $document_log->direction_out_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub9->Visible) { // planned_date_out_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub9" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub9" for="x_planned_date_out_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub9->caption() ?><?php echo ($document_log->planned_date_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub9->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub9">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub9" name="x_planned_date_out_sub9" id="x_planned_date_out_sub9" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub9->EditValue ?>"<?php echo $document_log->planned_date_out_sub9->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub9->ReadOnly && !$document_log->planned_date_out_sub9->Disabled && !isset($document_log->planned_date_out_sub9->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub9"><?php echo $document_log->planned_date_out_sub9->caption() ?><?php echo ($document_log->planned_date_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub9->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub9">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub9" name="x_planned_date_out_sub9" id="x_planned_date_out_sub9" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub9->EditValue ?>"<?php echo $document_log->planned_date_out_sub9->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub9->ReadOnly && !$document_log->planned_date_out_sub9->Disabled && !isset($document_log->planned_date_out_sub9->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub9->Visible) { // transmit_date_out_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub9" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub9" for="x_transmit_date_out_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub9->caption() ?><?php echo ($document_log->transmit_date_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub9" name="x_transmit_date_out_sub9" id="x_transmit_date_out_sub9" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub9->EditValue ?>"<?php echo $document_log->transmit_date_out_sub9->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub9->ReadOnly && !$document_log->transmit_date_out_sub9->Disabled && !isset($document_log->transmit_date_out_sub9->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub9"><?php echo $document_log->transmit_date_out_sub9->caption() ?><?php echo ($document_log->transmit_date_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub9" name="x_transmit_date_out_sub9" id="x_transmit_date_out_sub9" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub9->EditValue ?>"<?php echo $document_log->transmit_date_out_sub9->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub9->ReadOnly && !$document_log->transmit_date_out_sub9->Disabled && !isset($document_log->transmit_date_out_sub9->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub9->Visible) { // transmit_no_out_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub9" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub9" for="x_transmit_no_out_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub9->caption() ?><?php echo ($document_log->transmit_no_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub9" name="x_transmit_no_out_sub9" id="x_transmit_no_out_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub9->EditValue ?>"<?php echo $document_log->transmit_no_out_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub9"><?php echo $document_log->transmit_no_out_sub9->caption() ?><?php echo ($document_log->transmit_no_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub9" name="x_transmit_no_out_sub9" id="x_transmit_no_out_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub9->EditValue ?>"<?php echo $document_log->transmit_no_out_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub9->Visible) { // approval_status_out_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub9" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub9" for="x_approval_status_out_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub9->caption() ?><?php echo ($document_log->approval_status_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub9->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub9">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub9" name="x_approval_status_out_sub9" id="x_approval_status_out_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub9->EditValue ?>"<?php echo $document_log->approval_status_out_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub9"><?php echo $document_log->approval_status_out_sub9->caption() ?><?php echo ($document_log->approval_status_out_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub9->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub9">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub9" name="x_approval_status_out_sub9" id="x_approval_status_out_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub9->EditValue ?>"<?php echo $document_log->approval_status_out_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub9->Visible) { // direction_in_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub9" class="form-group row">
		<label id="elh_document_log_direction_in_sub9" for="x_direction_in_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub9->caption() ?><?php echo ($document_log->direction_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub9->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub9">
<input type="text" data-table="document_log" data-field="x_direction_in_sub9" name="x_direction_in_sub9" id="x_direction_in_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub9->EditValue ?>"<?php echo $document_log->direction_in_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub9"><?php echo $document_log->direction_in_sub9->caption() ?><?php echo ($document_log->direction_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub9->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub9">
<input type="text" data-table="document_log" data-field="x_direction_in_sub9" name="x_direction_in_sub9" id="x_direction_in_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub9->EditValue ?>"<?php echo $document_log->direction_in_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub9->Visible) { // transmit_no_in_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub9" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub9" for="x_transmit_no_in_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub9->caption() ?><?php echo ($document_log->transmit_no_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub9" name="x_transmit_no_in_sub9" id="x_transmit_no_in_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub9->EditValue ?>"<?php echo $document_log->transmit_no_in_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub9"><?php echo $document_log->transmit_no_in_sub9->caption() ?><?php echo ($document_log->transmit_no_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub9" name="x_transmit_no_in_sub9" id="x_transmit_no_in_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub9->EditValue ?>"<?php echo $document_log->transmit_no_in_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub9->Visible) { // approval_status_in_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub9" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub9" for="x_approval_status_in_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub9->caption() ?><?php echo ($document_log->approval_status_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub9->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub9">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub9" name="x_approval_status_in_sub9" id="x_approval_status_in_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub9->EditValue ?>"<?php echo $document_log->approval_status_in_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub9"><?php echo $document_log->approval_status_in_sub9->caption() ?><?php echo ($document_log->approval_status_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub9->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub9">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub9" name="x_approval_status_in_sub9" id="x_approval_status_in_sub9" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub9->EditValue ?>"<?php echo $document_log->approval_status_in_sub9->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub9->Visible) { // transmit_date_in_sub9 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub9" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub9" for="x_transmit_date_in_sub9" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub9->caption() ?><?php echo ($document_log->transmit_date_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub9" name="x_transmit_date_in_sub9" id="x_transmit_date_in_sub9" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub9->EditValue ?>"<?php echo $document_log->transmit_date_in_sub9->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub9->ReadOnly && !$document_log->transmit_date_in_sub9->Disabled && !isset($document_log->transmit_date_in_sub9->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub9">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub9"><?php echo $document_log->transmit_date_in_sub9->caption() ?><?php echo ($document_log->transmit_date_in_sub9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub9">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub9" name="x_transmit_date_in_sub9" id="x_transmit_date_in_sub9" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub9->EditValue ?>"<?php echo $document_log->transmit_date_in_sub9->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub9->ReadOnly && !$document_log->transmit_date_in_sub9->Disabled && !isset($document_log->transmit_date_in_sub9->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub10->Visible) { // submit_no_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_submit_no_sub10" class="form-group row">
		<label id="elh_document_log_submit_no_sub10" for="x_submit_no_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->submit_no_sub10->caption() ?><?php echo ($document_log->submit_no_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->submit_no_sub10->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub10">
<input type="text" data-table="document_log" data-field="x_submit_no_sub10" name="x_submit_no_sub10" id="x_submit_no_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub10->EditValue ?>"<?php echo $document_log->submit_no_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub10"><?php echo $document_log->submit_no_sub10->caption() ?><?php echo ($document_log->submit_no_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_sub10->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub10">
<input type="text" data-table="document_log" data-field="x_submit_no_sub10" name="x_submit_no_sub10" id="x_submit_no_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_sub10->EditValue ?>"<?php echo $document_log->submit_no_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub10->Visible) { // revision_no_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_revision_no_sub10" class="form-group row">
		<label id="elh_document_log_revision_no_sub10" for="x_revision_no_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->revision_no_sub10->caption() ?><?php echo ($document_log->revision_no_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->revision_no_sub10->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub10">
<input type="text" data-table="document_log" data-field="x_revision_no_sub10" name="x_revision_no_sub10" id="x_revision_no_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub10->EditValue ?>"<?php echo $document_log->revision_no_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub10"><?php echo $document_log->revision_no_sub10->caption() ?><?php echo ($document_log->revision_no_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_sub10->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub10">
<input type="text" data-table="document_log" data-field="x_revision_no_sub10" name="x_revision_no_sub10" id="x_revision_no_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_sub10->EditValue ?>"<?php echo $document_log->revision_no_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub10->Visible) { // direction_out_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_out_sub10" class="form-group row">
		<label id="elh_document_log_direction_out_sub10" for="x_direction_out_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_out_sub10->caption() ?><?php echo ($document_log->direction_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_out_sub10->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub10">
<input type="text" data-table="document_log" data-field="x_direction_out_sub10" name="x_direction_out_sub10" id="x_direction_out_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub10->EditValue ?>"<?php echo $document_log->direction_out_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_out_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub10"><?php echo $document_log->direction_out_sub10->caption() ?><?php echo ($document_log->direction_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_out_sub10->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub10">
<input type="text" data-table="document_log" data-field="x_direction_out_sub10" name="x_direction_out_sub10" id="x_direction_out_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_out_sub10->EditValue ?>"<?php echo $document_log->direction_out_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->direction_out_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub10->Visible) { // planned_date_out_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_planned_date_out_sub10" class="form-group row">
		<label id="elh_document_log_planned_date_out_sub10" for="x_planned_date_out_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->planned_date_out_sub10->caption() ?><?php echo ($document_log->planned_date_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->planned_date_out_sub10->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub10">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub10" name="x_planned_date_out_sub10" id="x_planned_date_out_sub10" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub10->EditValue ?>"<?php echo $document_log->planned_date_out_sub10->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub10->ReadOnly && !$document_log->planned_date_out_sub10->Disabled && !isset($document_log->planned_date_out_sub10->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_out_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub10"><?php echo $document_log->planned_date_out_sub10->caption() ?><?php echo ($document_log->planned_date_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_out_sub10->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub10">
<input type="text" data-table="document_log" data-field="x_planned_date_out_sub10" name="x_planned_date_out_sub10" id="x_planned_date_out_sub10" placeholder="<?php echo HtmlEncode($document_log->planned_date_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_out_sub10->EditValue ?>"<?php echo $document_log->planned_date_out_sub10->editAttributes() ?>>
<?php if (!$document_log->planned_date_out_sub10->ReadOnly && !$document_log->planned_date_out_sub10->Disabled && !isset($document_log->planned_date_out_sub10->EditAttrs["readonly"]) && !isset($document_log->planned_date_out_sub10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_planned_date_out_sub10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_out_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub10->Visible) { // transmit_date_out_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_out_sub10" class="form-group row">
		<label id="elh_document_log_transmit_date_out_sub10" for="x_transmit_date_out_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_out_sub10->caption() ?><?php echo ($document_log->transmit_date_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_out_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub10" name="x_transmit_date_out_sub10" id="x_transmit_date_out_sub10" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub10->EditValue ?>"<?php echo $document_log->transmit_date_out_sub10->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub10->ReadOnly && !$document_log->transmit_date_out_sub10->Disabled && !isset($document_log->transmit_date_out_sub10->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_out_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub10"><?php echo $document_log->transmit_date_out_sub10->caption() ?><?php echo ($document_log->transmit_date_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_out_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_date_out_sub10" name="x_transmit_date_out_sub10" id="x_transmit_date_out_sub10" placeholder="<?php echo HtmlEncode($document_log->transmit_date_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_out_sub10->EditValue ?>"<?php echo $document_log->transmit_date_out_sub10->editAttributes() ?>>
<?php if (!$document_log->transmit_date_out_sub10->ReadOnly && !$document_log->transmit_date_out_sub10->Disabled && !isset($document_log->transmit_date_out_sub10->EditAttrs["readonly"]) && !isset($document_log->transmit_date_out_sub10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_out_sub10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_out_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub10->Visible) { // transmit_no_out_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_out_sub10" class="form-group row">
		<label id="elh_document_log_transmit_no_out_sub10" for="x_transmit_no_out_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_out_sub10->caption() ?><?php echo ($document_log->transmit_no_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_out_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub10" name="x_transmit_no_out_sub10" id="x_transmit_no_out_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub10->EditValue ?>"<?php echo $document_log->transmit_no_out_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_out_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub10"><?php echo $document_log->transmit_no_out_sub10->caption() ?><?php echo ($document_log->transmit_no_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_out_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_no_out_sub10" name="x_transmit_no_out_sub10" id="x_transmit_no_out_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_out_sub10->EditValue ?>"<?php echo $document_log->transmit_no_out_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_out_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub10->Visible) { // approval_status_out_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_out_sub10" class="form-group row">
		<label id="elh_document_log_approval_status_out_sub10" for="x_approval_status_out_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_out_sub10->caption() ?><?php echo ($document_log->approval_status_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_out_sub10->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub10">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub10" name="x_approval_status_out_sub10" id="x_approval_status_out_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub10->EditValue ?>"<?php echo $document_log->approval_status_out_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_out_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub10"><?php echo $document_log->approval_status_out_sub10->caption() ?><?php echo ($document_log->approval_status_out_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_out_sub10->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub10">
<input type="text" data-table="document_log" data-field="x_approval_status_out_sub10" name="x_approval_status_out_sub10" id="x_approval_status_out_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_out_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_out_sub10->EditValue ?>"<?php echo $document_log->approval_status_out_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_out_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub10->Visible) { // direction_in_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_direction_in_sub10" class="form-group row">
		<label id="elh_document_log_direction_in_sub10" for="x_direction_in_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->direction_in_sub10->caption() ?><?php echo ($document_log->direction_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->direction_in_sub10->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub10">
<input type="text" data-table="document_log" data-field="x_direction_in_sub10" name="x_direction_in_sub10" id="x_direction_in_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub10->EditValue ?>"<?php echo $document_log->direction_in_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_in_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub10"><?php echo $document_log->direction_in_sub10->caption() ?><?php echo ($document_log->direction_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_in_sub10->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub10">
<input type="text" data-table="document_log" data-field="x_direction_in_sub10" name="x_direction_in_sub10" id="x_direction_in_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_in_sub10->EditValue ?>"<?php echo $document_log->direction_in_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->direction_in_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub10->Visible) { // transmit_no_in_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no_in_sub10" class="form-group row">
		<label id="elh_document_log_transmit_no_in_sub10" for="x_transmit_no_in_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_no_in_sub10->caption() ?><?php echo ($document_log->transmit_no_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_in_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub10" name="x_transmit_no_in_sub10" id="x_transmit_no_in_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub10->EditValue ?>"<?php echo $document_log->transmit_no_in_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_in_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub10"><?php echo $document_log->transmit_no_in_sub10->caption() ?><?php echo ($document_log->transmit_no_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_in_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_no_in_sub10" name="x_transmit_no_in_sub10" id="x_transmit_no_in_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_in_sub10->EditValue ?>"<?php echo $document_log->transmit_no_in_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_in_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub10->Visible) { // approval_status_in_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_approval_status_in_sub10" class="form-group row">
		<label id="elh_document_log_approval_status_in_sub10" for="x_approval_status_in_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->approval_status_in_sub10->caption() ?><?php echo ($document_log->approval_status_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->approval_status_in_sub10->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub10">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub10" name="x_approval_status_in_sub10" id="x_approval_status_in_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub10->EditValue ?>"<?php echo $document_log->approval_status_in_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_in_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub10"><?php echo $document_log->approval_status_in_sub10->caption() ?><?php echo ($document_log->approval_status_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_in_sub10->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub10">
<input type="text" data-table="document_log" data-field="x_approval_status_in_sub10" name="x_approval_status_in_sub10" id="x_approval_status_in_sub10" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_in_sub10->EditValue ?>"<?php echo $document_log->approval_status_in_sub10->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_in_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub10->Visible) { // transmit_date_in_sub10 ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date_in_sub10" class="form-group row">
		<label id="elh_document_log_transmit_date_in_sub10" for="x_transmit_date_in_sub10" class="<?php echo $document_log_add->LeftColumnClass ?>"><?php echo $document_log->transmit_date_in_sub10->caption() ?><?php echo ($document_log->transmit_date_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_add->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_in_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub10" name="x_transmit_date_in_sub10" id="x_transmit_date_in_sub10" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub10->EditValue ?>"<?php echo $document_log->transmit_date_in_sub10->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub10->ReadOnly && !$document_log->transmit_date_in_sub10->Disabled && !isset($document_log->transmit_date_in_sub10->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_in_sub10">
		<td class="<?php echo $document_log_add->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub10"><?php echo $document_log->transmit_date_in_sub10->caption() ?><?php echo ($document_log->transmit_date_in_sub10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_in_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub10">
<input type="text" data-table="document_log" data-field="x_transmit_date_in_sub10" name="x_transmit_date_in_sub10" id="x_transmit_date_in_sub10" placeholder="<?php echo HtmlEncode($document_log->transmit_date_in_sub10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_in_sub10->EditValue ?>"<?php echo $document_log->transmit_date_in_sub10->editAttributes() ?>>
<?php if (!$document_log->transmit_date_in_sub10->ReadOnly && !$document_log->transmit_date_in_sub10->Disabled && !isset($document_log->transmit_date_in_sub10->EditAttrs["readonly"]) && !isset($document_log->transmit_date_in_sub10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logadd", "x_transmit_date_in_sub10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_in_sub10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$document_log_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_log_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_log_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_log_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_log_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_log_add->terminate();
?>