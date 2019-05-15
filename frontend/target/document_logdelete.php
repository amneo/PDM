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
$document_log_delete = new document_log_delete();

// Run the page
$document_log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_log_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fdocument_logdelete = currentForm = new ew.Form("fdocument_logdelete", "delete");

// Form_CustomValidate event
fdocument_logdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_logdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_log_delete->showPageHeader(); ?>
<?php
$document_log_delete->showMessage();
?>
<form name="fdocument_logdelete" id="fdocument_logdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_log_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_log_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($document_log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<th class="<?php echo $document_log->firelink_doc_no->headerCellClass() ?>"><span id="elh_document_log_firelink_doc_no" class="document_log_firelink_doc_no"><?php echo $document_log->firelink_doc_no->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
		<th class="<?php echo $document_log->project_name->headerCellClass() ?>"><span id="elh_document_log_project_name" class="document_log_project_name"><?php echo $document_log->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
		<th class="<?php echo $document_log->document_tittle->headerCellClass() ?>"><span id="elh_document_log_document_tittle" class="document_log_document_tittle"><?php echo $document_log->document_tittle->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
		<th class="<?php echo $document_log->current_status->headerCellClass() ?>"><span id="elh_document_log_current_status" class="document_log_current_status"><?php echo $document_log->current_status->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub1->Visible) { // submit_no_sub1 ?>
		<th class="<?php echo $document_log->submit_no_sub1->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub1" class="document_log_submit_no_sub1"><?php echo $document_log->submit_no_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub1->Visible) { // revision_no_sub1 ?>
		<th class="<?php echo $document_log->revision_no_sub1->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub1" class="document_log_revision_no_sub1"><?php echo $document_log->revision_no_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub1->Visible) { // direction_out_sub1 ?>
		<th class="<?php echo $document_log->direction_out_sub1->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub1" class="document_log_direction_out_sub1"><?php echo $document_log->direction_out_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub1->Visible) { // planned_date_out_sub1 ?>
		<th class="<?php echo $document_log->planned_date_out_sub1->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub1" class="document_log_planned_date_out_sub1"><?php echo $document_log->planned_date_out_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub1->Visible) { // transmit_date_out_sub1 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub1->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub1" class="document_log_transmit_date_out_sub1"><?php echo $document_log->transmit_date_out_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub1->Visible) { // transmit_no_out_sub1 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub1->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub1" class="document_log_transmit_no_out_sub1"><?php echo $document_log->transmit_no_out_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub1->Visible) { // approval_status_out_sub1 ?>
		<th class="<?php echo $document_log->approval_status_out_sub1->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub1" class="document_log_approval_status_out_sub1"><?php echo $document_log->approval_status_out_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_file_sub1->Visible) { // direction_out_file_sub1 ?>
		<th class="<?php echo $document_log->direction_out_file_sub1->headerCellClass() ?>"><span id="elh_document_log_direction_out_file_sub1" class="document_log_direction_out_file_sub1"><?php echo $document_log->direction_out_file_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub1->Visible) { // direction_in_sub1 ?>
		<th class="<?php echo $document_log->direction_in_sub1->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub1" class="document_log_direction_in_sub1"><?php echo $document_log->direction_in_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub1->Visible) { // transmit_no_in_sub1 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub1->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub1" class="document_log_transmit_no_in_sub1"><?php echo $document_log->transmit_no_in_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub1->Visible) { // approval_status_in_sub1 ?>
		<th class="<?php echo $document_log->approval_status_in_sub1->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub1" class="document_log_approval_status_in_sub1"><?php echo $document_log->approval_status_in_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub1->Visible) { // transmit_date_in_sub1 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub1->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub1" class="document_log_transmit_date_in_sub1"><?php echo $document_log->transmit_date_in_sub1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub2->Visible) { // submit_no_sub2 ?>
		<th class="<?php echo $document_log->submit_no_sub2->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub2" class="document_log_submit_no_sub2"><?php echo $document_log->submit_no_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub2->Visible) { // revision_no_sub2 ?>
		<th class="<?php echo $document_log->revision_no_sub2->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub2" class="document_log_revision_no_sub2"><?php echo $document_log->revision_no_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub2->Visible) { // direction_out_sub2 ?>
		<th class="<?php echo $document_log->direction_out_sub2->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub2" class="document_log_direction_out_sub2"><?php echo $document_log->direction_out_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub2->Visible) { // planned_date_out_sub2 ?>
		<th class="<?php echo $document_log->planned_date_out_sub2->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub2" class="document_log_planned_date_out_sub2"><?php echo $document_log->planned_date_out_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub2->Visible) { // transmit_date_out_sub2 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub2->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub2" class="document_log_transmit_date_out_sub2"><?php echo $document_log->transmit_date_out_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub2->Visible) { // transmit_no_out_sub2 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub2->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub2" class="document_log_transmit_no_out_sub2"><?php echo $document_log->transmit_no_out_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub2->Visible) { // approval_status_out_sub2 ?>
		<th class="<?php echo $document_log->approval_status_out_sub2->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub2" class="document_log_approval_status_out_sub2"><?php echo $document_log->approval_status_out_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub2->Visible) { // direction_in_sub2 ?>
		<th class="<?php echo $document_log->direction_in_sub2->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub2" class="document_log_direction_in_sub2"><?php echo $document_log->direction_in_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub2->Visible) { // transmit_no_in_sub2 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub2->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub2" class="document_log_transmit_no_in_sub2"><?php echo $document_log->transmit_no_in_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub2->Visible) { // approval_status_in_sub2 ?>
		<th class="<?php echo $document_log->approval_status_in_sub2->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub2" class="document_log_approval_status_in_sub2"><?php echo $document_log->approval_status_in_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub2->Visible) { // transmit_date_in_sub2 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub2->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub2" class="document_log_transmit_date_in_sub2"><?php echo $document_log->transmit_date_in_sub2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub3->Visible) { // submit_no_sub3 ?>
		<th class="<?php echo $document_log->submit_no_sub3->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub3" class="document_log_submit_no_sub3"><?php echo $document_log->submit_no_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub3->Visible) { // revision_no_sub3 ?>
		<th class="<?php echo $document_log->revision_no_sub3->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub3" class="document_log_revision_no_sub3"><?php echo $document_log->revision_no_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub3->Visible) { // direction_out_sub3 ?>
		<th class="<?php echo $document_log->direction_out_sub3->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub3" class="document_log_direction_out_sub3"><?php echo $document_log->direction_out_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub3->Visible) { // planned_date_out_sub3 ?>
		<th class="<?php echo $document_log->planned_date_out_sub3->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub3" class="document_log_planned_date_out_sub3"><?php echo $document_log->planned_date_out_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub3->Visible) { // transmit_date_out_sub3 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub3->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub3" class="document_log_transmit_date_out_sub3"><?php echo $document_log->transmit_date_out_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub3->Visible) { // transmit_no_out_sub3 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub3->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub3" class="document_log_transmit_no_out_sub3"><?php echo $document_log->transmit_no_out_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub3->Visible) { // approval_status_out_sub3 ?>
		<th class="<?php echo $document_log->approval_status_out_sub3->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub3" class="document_log_approval_status_out_sub3"><?php echo $document_log->approval_status_out_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub3->Visible) { // direction_in_sub3 ?>
		<th class="<?php echo $document_log->direction_in_sub3->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub3" class="document_log_direction_in_sub3"><?php echo $document_log->direction_in_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub3->Visible) { // transmit_no_in_sub3 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub3->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub3" class="document_log_transmit_no_in_sub3"><?php echo $document_log->transmit_no_in_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub3->Visible) { // approval_status_in_sub3 ?>
		<th class="<?php echo $document_log->approval_status_in_sub3->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub3" class="document_log_approval_status_in_sub3"><?php echo $document_log->approval_status_in_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub3->Visible) { // transmit_date_in_sub3 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub3->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub3" class="document_log_transmit_date_in_sub3"><?php echo $document_log->transmit_date_in_sub3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub4->Visible) { // submit_no_sub4 ?>
		<th class="<?php echo $document_log->submit_no_sub4->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub4" class="document_log_submit_no_sub4"><?php echo $document_log->submit_no_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub4->Visible) { // revision_no_sub4 ?>
		<th class="<?php echo $document_log->revision_no_sub4->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub4" class="document_log_revision_no_sub4"><?php echo $document_log->revision_no_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub4->Visible) { // direction_out_sub4 ?>
		<th class="<?php echo $document_log->direction_out_sub4->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub4" class="document_log_direction_out_sub4"><?php echo $document_log->direction_out_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub4->Visible) { // planned_date_out_sub4 ?>
		<th class="<?php echo $document_log->planned_date_out_sub4->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub4" class="document_log_planned_date_out_sub4"><?php echo $document_log->planned_date_out_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub4->Visible) { // transmit_date_out_sub4 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub4->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub4" class="document_log_transmit_date_out_sub4"><?php echo $document_log->transmit_date_out_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub4->Visible) { // transmit_no_out_sub4 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub4->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub4" class="document_log_transmit_no_out_sub4"><?php echo $document_log->transmit_no_out_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub4->Visible) { // approval_status_out_sub4 ?>
		<th class="<?php echo $document_log->approval_status_out_sub4->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub4" class="document_log_approval_status_out_sub4"><?php echo $document_log->approval_status_out_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub4->Visible) { // direction_in_sub4 ?>
		<th class="<?php echo $document_log->direction_in_sub4->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub4" class="document_log_direction_in_sub4"><?php echo $document_log->direction_in_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub4->Visible) { // transmit_no_in_sub4 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub4->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub4" class="document_log_transmit_no_in_sub4"><?php echo $document_log->transmit_no_in_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub4->Visible) { // approval_status_in_sub4 ?>
		<th class="<?php echo $document_log->approval_status_in_sub4->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub4" class="document_log_approval_status_in_sub4"><?php echo $document_log->approval_status_in_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_file_sub4->Visible) { // direction_in_file_sub4 ?>
		<th class="<?php echo $document_log->direction_in_file_sub4->headerCellClass() ?>"><span id="elh_document_log_direction_in_file_sub4" class="document_log_direction_in_file_sub4"><?php echo $document_log->direction_in_file_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub4->Visible) { // transmit_date_in_sub4 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub4->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub4" class="document_log_transmit_date_in_sub4"><?php echo $document_log->transmit_date_in_sub4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub5->Visible) { // submit_no_sub5 ?>
		<th class="<?php echo $document_log->submit_no_sub5->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub5" class="document_log_submit_no_sub5"><?php echo $document_log->submit_no_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub5->Visible) { // revision_no_sub5 ?>
		<th class="<?php echo $document_log->revision_no_sub5->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub5" class="document_log_revision_no_sub5"><?php echo $document_log->revision_no_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub5->Visible) { // direction_out_sub5 ?>
		<th class="<?php echo $document_log->direction_out_sub5->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub5" class="document_log_direction_out_sub5"><?php echo $document_log->direction_out_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub5->Visible) { // planned_date_out_sub5 ?>
		<th class="<?php echo $document_log->planned_date_out_sub5->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub5" class="document_log_planned_date_out_sub5"><?php echo $document_log->planned_date_out_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub5->Visible) { // transmit_date_out_sub5 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub5->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub5" class="document_log_transmit_date_out_sub5"><?php echo $document_log->transmit_date_out_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub5->Visible) { // transmit_no_out_sub5 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub5->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub5" class="document_log_transmit_no_out_sub5"><?php echo $document_log->transmit_no_out_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub5->Visible) { // approval_status_out_sub5 ?>
		<th class="<?php echo $document_log->approval_status_out_sub5->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub5" class="document_log_approval_status_out_sub5"><?php echo $document_log->approval_status_out_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub5->Visible) { // direction_in_sub5 ?>
		<th class="<?php echo $document_log->direction_in_sub5->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub5" class="document_log_direction_in_sub5"><?php echo $document_log->direction_in_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub5->Visible) { // transmit_no_in_sub5 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub5->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub5" class="document_log_transmit_no_in_sub5"><?php echo $document_log->transmit_no_in_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub5->Visible) { // approval_status_in_sub5 ?>
		<th class="<?php echo $document_log->approval_status_in_sub5->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub5" class="document_log_approval_status_in_sub5"><?php echo $document_log->approval_status_in_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_file_sub5->Visible) { // direction_in_file_sub5 ?>
		<th class="<?php echo $document_log->direction_in_file_sub5->headerCellClass() ?>"><span id="elh_document_log_direction_in_file_sub5" class="document_log_direction_in_file_sub5"><?php echo $document_log->direction_in_file_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub5->Visible) { // transmit_date_in_sub5 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub5->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub5" class="document_log_transmit_date_in_sub5"><?php echo $document_log->transmit_date_in_sub5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub6->Visible) { // submit_no_sub6 ?>
		<th class="<?php echo $document_log->submit_no_sub6->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub6" class="document_log_submit_no_sub6"><?php echo $document_log->submit_no_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub6->Visible) { // revision_no_sub6 ?>
		<th class="<?php echo $document_log->revision_no_sub6->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub6" class="document_log_revision_no_sub6"><?php echo $document_log->revision_no_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub6->Visible) { // direction_out_sub6 ?>
		<th class="<?php echo $document_log->direction_out_sub6->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub6" class="document_log_direction_out_sub6"><?php echo $document_log->direction_out_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub6->Visible) { // planned_date_out_sub6 ?>
		<th class="<?php echo $document_log->planned_date_out_sub6->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub6" class="document_log_planned_date_out_sub6"><?php echo $document_log->planned_date_out_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub6->Visible) { // transmit_date_out_sub6 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub6->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub6" class="document_log_transmit_date_out_sub6"><?php echo $document_log->transmit_date_out_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub6->Visible) { // transmit_no_out_sub6 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub6->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub6" class="document_log_transmit_no_out_sub6"><?php echo $document_log->transmit_no_out_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub6->Visible) { // approval_status_out_sub6 ?>
		<th class="<?php echo $document_log->approval_status_out_sub6->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub6" class="document_log_approval_status_out_sub6"><?php echo $document_log->approval_status_out_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub6->Visible) { // direction_in_sub6 ?>
		<th class="<?php echo $document_log->direction_in_sub6->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub6" class="document_log_direction_in_sub6"><?php echo $document_log->direction_in_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub6->Visible) { // transmit_no_in_sub6 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub6->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub6" class="document_log_transmit_no_in_sub6"><?php echo $document_log->transmit_no_in_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub6->Visible) { // approval_status_in_sub6 ?>
		<th class="<?php echo $document_log->approval_status_in_sub6->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub6" class="document_log_approval_status_in_sub6"><?php echo $document_log->approval_status_in_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_file_sub6->Visible) { // direction_in_file_sub6 ?>
		<th class="<?php echo $document_log->direction_in_file_sub6->headerCellClass() ?>"><span id="elh_document_log_direction_in_file_sub6" class="document_log_direction_in_file_sub6"><?php echo $document_log->direction_in_file_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub6->Visible) { // transmit_date_in_sub6 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub6->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub6" class="document_log_transmit_date_in_sub6"><?php echo $document_log->transmit_date_in_sub6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub7->Visible) { // submit_no_sub7 ?>
		<th class="<?php echo $document_log->submit_no_sub7->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub7" class="document_log_submit_no_sub7"><?php echo $document_log->submit_no_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub7->Visible) { // revision_no_sub7 ?>
		<th class="<?php echo $document_log->revision_no_sub7->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub7" class="document_log_revision_no_sub7"><?php echo $document_log->revision_no_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub7->Visible) { // direction_out_sub7 ?>
		<th class="<?php echo $document_log->direction_out_sub7->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub7" class="document_log_direction_out_sub7"><?php echo $document_log->direction_out_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub7->Visible) { // planned_date_out_sub7 ?>
		<th class="<?php echo $document_log->planned_date_out_sub7->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub7" class="document_log_planned_date_out_sub7"><?php echo $document_log->planned_date_out_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub7->Visible) { // transmit_date_out_sub7 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub7->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub7" class="document_log_transmit_date_out_sub7"><?php echo $document_log->transmit_date_out_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub7->Visible) { // transmit_no_out_sub7 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub7->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub7" class="document_log_transmit_no_out_sub7"><?php echo $document_log->transmit_no_out_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub7->Visible) { // approval_status_out_sub7 ?>
		<th class="<?php echo $document_log->approval_status_out_sub7->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub7" class="document_log_approval_status_out_sub7"><?php echo $document_log->approval_status_out_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub7->Visible) { // direction_in_sub7 ?>
		<th class="<?php echo $document_log->direction_in_sub7->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub7" class="document_log_direction_in_sub7"><?php echo $document_log->direction_in_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub7->Visible) { // transmit_no_in_sub7 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub7->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub7" class="document_log_transmit_no_in_sub7"><?php echo $document_log->transmit_no_in_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub7->Visible) { // approval_status_in_sub7 ?>
		<th class="<?php echo $document_log->approval_status_in_sub7->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub7" class="document_log_approval_status_in_sub7"><?php echo $document_log->approval_status_in_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub7->Visible) { // transmit_date_in_sub7 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub7->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub7" class="document_log_transmit_date_in_sub7"><?php echo $document_log->transmit_date_in_sub7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub8->Visible) { // submit_no_sub8 ?>
		<th class="<?php echo $document_log->submit_no_sub8->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub8" class="document_log_submit_no_sub8"><?php echo $document_log->submit_no_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub8->Visible) { // revision_no_sub8 ?>
		<th class="<?php echo $document_log->revision_no_sub8->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub8" class="document_log_revision_no_sub8"><?php echo $document_log->revision_no_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub8->Visible) { // direction_out_sub8 ?>
		<th class="<?php echo $document_log->direction_out_sub8->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub8" class="document_log_direction_out_sub8"><?php echo $document_log->direction_out_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub8->Visible) { // planned_date_out_sub8 ?>
		<th class="<?php echo $document_log->planned_date_out_sub8->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub8" class="document_log_planned_date_out_sub8"><?php echo $document_log->planned_date_out_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub8->Visible) { // transmit_date_out_sub8 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub8->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub8" class="document_log_transmit_date_out_sub8"><?php echo $document_log->transmit_date_out_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub8->Visible) { // transmit_no_out_sub8 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub8->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub8" class="document_log_transmit_no_out_sub8"><?php echo $document_log->transmit_no_out_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub8->Visible) { // approval_status_out_sub8 ?>
		<th class="<?php echo $document_log->approval_status_out_sub8->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub8" class="document_log_approval_status_out_sub8"><?php echo $document_log->approval_status_out_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_file_sub8->Visible) { // direction_out_file_sub8 ?>
		<th class="<?php echo $document_log->direction_out_file_sub8->headerCellClass() ?>"><span id="elh_document_log_direction_out_file_sub8" class="document_log_direction_out_file_sub8"><?php echo $document_log->direction_out_file_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub8->Visible) { // direction_in_sub8 ?>
		<th class="<?php echo $document_log->direction_in_sub8->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub8" class="document_log_direction_in_sub8"><?php echo $document_log->direction_in_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub8->Visible) { // transmit_no_in_sub8 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub8->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub8" class="document_log_transmit_no_in_sub8"><?php echo $document_log->transmit_no_in_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub8->Visible) { // approval_status_in_sub8 ?>
		<th class="<?php echo $document_log->approval_status_in_sub8->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub8" class="document_log_approval_status_in_sub8"><?php echo $document_log->approval_status_in_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub8->Visible) { // transmit_date_in_sub8 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub8->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub8" class="document_log_transmit_date_in_sub8"><?php echo $document_log->transmit_date_in_sub8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub9->Visible) { // submit_no_sub9 ?>
		<th class="<?php echo $document_log->submit_no_sub9->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub9" class="document_log_submit_no_sub9"><?php echo $document_log->submit_no_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub9->Visible) { // revision_no_sub9 ?>
		<th class="<?php echo $document_log->revision_no_sub9->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub9" class="document_log_revision_no_sub9"><?php echo $document_log->revision_no_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub9->Visible) { // direction_out_sub9 ?>
		<th class="<?php echo $document_log->direction_out_sub9->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub9" class="document_log_direction_out_sub9"><?php echo $document_log->direction_out_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub9->Visible) { // planned_date_out_sub9 ?>
		<th class="<?php echo $document_log->planned_date_out_sub9->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub9" class="document_log_planned_date_out_sub9"><?php echo $document_log->planned_date_out_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub9->Visible) { // transmit_date_out_sub9 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub9->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub9" class="document_log_transmit_date_out_sub9"><?php echo $document_log->transmit_date_out_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub9->Visible) { // transmit_no_out_sub9 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub9->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub9" class="document_log_transmit_no_out_sub9"><?php echo $document_log->transmit_no_out_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub9->Visible) { // approval_status_out_sub9 ?>
		<th class="<?php echo $document_log->approval_status_out_sub9->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub9" class="document_log_approval_status_out_sub9"><?php echo $document_log->approval_status_out_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub9->Visible) { // direction_in_sub9 ?>
		<th class="<?php echo $document_log->direction_in_sub9->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub9" class="document_log_direction_in_sub9"><?php echo $document_log->direction_in_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub9->Visible) { // transmit_no_in_sub9 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub9->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub9" class="document_log_transmit_no_in_sub9"><?php echo $document_log->transmit_no_in_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub9->Visible) { // approval_status_in_sub9 ?>
		<th class="<?php echo $document_log->approval_status_in_sub9->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub9" class="document_log_approval_status_in_sub9"><?php echo $document_log->approval_status_in_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub9->Visible) { // transmit_date_in_sub9 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub9->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub9" class="document_log_transmit_date_in_sub9"><?php echo $document_log->transmit_date_in_sub9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_sub10->Visible) { // submit_no_sub10 ?>
		<th class="<?php echo $document_log->submit_no_sub10->headerCellClass() ?>"><span id="elh_document_log_submit_no_sub10" class="document_log_submit_no_sub10"><?php echo $document_log->submit_no_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_sub10->Visible) { // revision_no_sub10 ?>
		<th class="<?php echo $document_log->revision_no_sub10->headerCellClass() ?>"><span id="elh_document_log_revision_no_sub10" class="document_log_revision_no_sub10"><?php echo $document_log->revision_no_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_out_sub10->Visible) { // direction_out_sub10 ?>
		<th class="<?php echo $document_log->direction_out_sub10->headerCellClass() ?>"><span id="elh_document_log_direction_out_sub10" class="document_log_direction_out_sub10"><?php echo $document_log->direction_out_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_out_sub10->Visible) { // planned_date_out_sub10 ?>
		<th class="<?php echo $document_log->planned_date_out_sub10->headerCellClass() ?>"><span id="elh_document_log_planned_date_out_sub10" class="document_log_planned_date_out_sub10"><?php echo $document_log->planned_date_out_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub10->Visible) { // transmit_date_out_sub10 ?>
		<th class="<?php echo $document_log->transmit_date_out_sub10->headerCellClass() ?>"><span id="elh_document_log_transmit_date_out_sub10" class="document_log_transmit_date_out_sub10"><?php echo $document_log->transmit_date_out_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub10->Visible) { // transmit_no_out_sub10 ?>
		<th class="<?php echo $document_log->transmit_no_out_sub10->headerCellClass() ?>"><span id="elh_document_log_transmit_no_out_sub10" class="document_log_transmit_no_out_sub10"><?php echo $document_log->transmit_no_out_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_out_sub10->Visible) { // approval_status_out_sub10 ?>
		<th class="<?php echo $document_log->approval_status_out_sub10->headerCellClass() ?>"><span id="elh_document_log_approval_status_out_sub10" class="document_log_approval_status_out_sub10"><?php echo $document_log->approval_status_out_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_in_sub10->Visible) { // direction_in_sub10 ?>
		<th class="<?php echo $document_log->direction_in_sub10->headerCellClass() ?>"><span id="elh_document_log_direction_in_sub10" class="document_log_direction_in_sub10"><?php echo $document_log->direction_in_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub10->Visible) { // transmit_no_in_sub10 ?>
		<th class="<?php echo $document_log->transmit_no_in_sub10->headerCellClass() ?>"><span id="elh_document_log_transmit_no_in_sub10" class="document_log_transmit_no_in_sub10"><?php echo $document_log->transmit_no_in_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_in_sub10->Visible) { // approval_status_in_sub10 ?>
		<th class="<?php echo $document_log->approval_status_in_sub10->headerCellClass() ?>"><span id="elh_document_log_approval_status_in_sub10" class="document_log_approval_status_in_sub10"><?php echo $document_log->approval_status_in_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub10->Visible) { // transmit_date_in_sub10 ?>
		<th class="<?php echo $document_log->transmit_date_in_sub10->headerCellClass() ?>"><span id="elh_document_log_transmit_date_in_sub10" class="document_log_transmit_date_in_sub10"><?php echo $document_log->transmit_date_in_sub10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
		<th class="<?php echo $document_log->log_updatedon->headerCellClass() ?>"><span id="elh_document_log_log_updatedon" class="document_log_log_updatedon"><?php echo $document_log->log_updatedon->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$document_log_delete->RecCnt = 0;
$i = 0;
while (!$document_log_delete->Recordset->EOF) {
	$document_log_delete->RecCnt++;
	$document_log_delete->RowCnt++;

	// Set row properties
	$document_log->resetAttributes();
	$document_log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$document_log_delete->loadRowValues($document_log_delete->Recordset);

	// Render row
	$document_log_delete->renderRow();
?>
	<tr<?php echo $document_log->rowAttributes() ?>>
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_firelink_doc_no" class="document_log_firelink_doc_no">
<span<?php echo $document_log->firelink_doc_no->viewAttributes() ?>>
<?php echo $document_log->firelink_doc_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
		<td<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_project_name" class="document_log_project_name">
<span<?php echo $document_log->project_name->viewAttributes() ?>>
<?php echo $document_log->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
		<td<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_document_tittle" class="document_log_document_tittle">
<span<?php echo $document_log->document_tittle->viewAttributes() ?>>
<?php echo $document_log->document_tittle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
		<td<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_current_status" class="document_log_current_status">
<span<?php echo $document_log->current_status->viewAttributes() ?>>
<?php echo $document_log->current_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub1->Visible) { // submit_no_sub1 ?>
		<td<?php echo $document_log->submit_no_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub1" class="document_log_submit_no_sub1">
<span<?php echo $document_log->submit_no_sub1->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub1->Visible) { // revision_no_sub1 ?>
		<td<?php echo $document_log->revision_no_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub1" class="document_log_revision_no_sub1">
<span<?php echo $document_log->revision_no_sub1->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub1->Visible) { // direction_out_sub1 ?>
		<td<?php echo $document_log->direction_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub1" class="document_log_direction_out_sub1">
<span<?php echo $document_log->direction_out_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub1->Visible) { // planned_date_out_sub1 ?>
		<td<?php echo $document_log->planned_date_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub1" class="document_log_planned_date_out_sub1">
<span<?php echo $document_log->planned_date_out_sub1->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub1->Visible) { // transmit_date_out_sub1 ?>
		<td<?php echo $document_log->transmit_date_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub1" class="document_log_transmit_date_out_sub1">
<span<?php echo $document_log->transmit_date_out_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub1->Visible) { // transmit_no_out_sub1 ?>
		<td<?php echo $document_log->transmit_no_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub1" class="document_log_transmit_no_out_sub1">
<span<?php echo $document_log->transmit_no_out_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub1->Visible) { // approval_status_out_sub1 ?>
		<td<?php echo $document_log->approval_status_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub1" class="document_log_approval_status_out_sub1">
<span<?php echo $document_log->approval_status_out_sub1->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_file_sub1->Visible) { // direction_out_file_sub1 ?>
		<td<?php echo $document_log->direction_out_file_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_file_sub1" class="document_log_direction_out_file_sub1">
<span<?php echo $document_log->direction_out_file_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_out_file_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub1->Visible) { // direction_in_sub1 ?>
		<td<?php echo $document_log->direction_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub1" class="document_log_direction_in_sub1">
<span<?php echo $document_log->direction_in_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub1->Visible) { // transmit_no_in_sub1 ?>
		<td<?php echo $document_log->transmit_no_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub1" class="document_log_transmit_no_in_sub1">
<span<?php echo $document_log->transmit_no_in_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub1->Visible) { // approval_status_in_sub1 ?>
		<td<?php echo $document_log->approval_status_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub1" class="document_log_approval_status_in_sub1">
<span<?php echo $document_log->approval_status_in_sub1->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub1->Visible) { // transmit_date_in_sub1 ?>
		<td<?php echo $document_log->transmit_date_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub1" class="document_log_transmit_date_in_sub1">
<span<?php echo $document_log->transmit_date_in_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub2->Visible) { // submit_no_sub2 ?>
		<td<?php echo $document_log->submit_no_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub2" class="document_log_submit_no_sub2">
<span<?php echo $document_log->submit_no_sub2->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub2->Visible) { // revision_no_sub2 ?>
		<td<?php echo $document_log->revision_no_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub2" class="document_log_revision_no_sub2">
<span<?php echo $document_log->revision_no_sub2->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub2->Visible) { // direction_out_sub2 ?>
		<td<?php echo $document_log->direction_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub2" class="document_log_direction_out_sub2">
<span<?php echo $document_log->direction_out_sub2->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub2->Visible) { // planned_date_out_sub2 ?>
		<td<?php echo $document_log->planned_date_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub2" class="document_log_planned_date_out_sub2">
<span<?php echo $document_log->planned_date_out_sub2->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub2->Visible) { // transmit_date_out_sub2 ?>
		<td<?php echo $document_log->transmit_date_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub2" class="document_log_transmit_date_out_sub2">
<span<?php echo $document_log->transmit_date_out_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub2->Visible) { // transmit_no_out_sub2 ?>
		<td<?php echo $document_log->transmit_no_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub2" class="document_log_transmit_no_out_sub2">
<span<?php echo $document_log->transmit_no_out_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub2->Visible) { // approval_status_out_sub2 ?>
		<td<?php echo $document_log->approval_status_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub2" class="document_log_approval_status_out_sub2">
<span<?php echo $document_log->approval_status_out_sub2->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub2->Visible) { // direction_in_sub2 ?>
		<td<?php echo $document_log->direction_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub2" class="document_log_direction_in_sub2">
<span<?php echo $document_log->direction_in_sub2->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub2->Visible) { // transmit_no_in_sub2 ?>
		<td<?php echo $document_log->transmit_no_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub2" class="document_log_transmit_no_in_sub2">
<span<?php echo $document_log->transmit_no_in_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub2->Visible) { // approval_status_in_sub2 ?>
		<td<?php echo $document_log->approval_status_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub2" class="document_log_approval_status_in_sub2">
<span<?php echo $document_log->approval_status_in_sub2->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub2->Visible) { // transmit_date_in_sub2 ?>
		<td<?php echo $document_log->transmit_date_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub2" class="document_log_transmit_date_in_sub2">
<span<?php echo $document_log->transmit_date_in_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub3->Visible) { // submit_no_sub3 ?>
		<td<?php echo $document_log->submit_no_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub3" class="document_log_submit_no_sub3">
<span<?php echo $document_log->submit_no_sub3->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub3->Visible) { // revision_no_sub3 ?>
		<td<?php echo $document_log->revision_no_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub3" class="document_log_revision_no_sub3">
<span<?php echo $document_log->revision_no_sub3->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub3->Visible) { // direction_out_sub3 ?>
		<td<?php echo $document_log->direction_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub3" class="document_log_direction_out_sub3">
<span<?php echo $document_log->direction_out_sub3->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub3->Visible) { // planned_date_out_sub3 ?>
		<td<?php echo $document_log->planned_date_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub3" class="document_log_planned_date_out_sub3">
<span<?php echo $document_log->planned_date_out_sub3->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub3->Visible) { // transmit_date_out_sub3 ?>
		<td<?php echo $document_log->transmit_date_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub3" class="document_log_transmit_date_out_sub3">
<span<?php echo $document_log->transmit_date_out_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub3->Visible) { // transmit_no_out_sub3 ?>
		<td<?php echo $document_log->transmit_no_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub3" class="document_log_transmit_no_out_sub3">
<span<?php echo $document_log->transmit_no_out_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub3->Visible) { // approval_status_out_sub3 ?>
		<td<?php echo $document_log->approval_status_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub3" class="document_log_approval_status_out_sub3">
<span<?php echo $document_log->approval_status_out_sub3->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub3->Visible) { // direction_in_sub3 ?>
		<td<?php echo $document_log->direction_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub3" class="document_log_direction_in_sub3">
<span<?php echo $document_log->direction_in_sub3->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub3->Visible) { // transmit_no_in_sub3 ?>
		<td<?php echo $document_log->transmit_no_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub3" class="document_log_transmit_no_in_sub3">
<span<?php echo $document_log->transmit_no_in_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub3->Visible) { // approval_status_in_sub3 ?>
		<td<?php echo $document_log->approval_status_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub3" class="document_log_approval_status_in_sub3">
<span<?php echo $document_log->approval_status_in_sub3->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub3->Visible) { // transmit_date_in_sub3 ?>
		<td<?php echo $document_log->transmit_date_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub3" class="document_log_transmit_date_in_sub3">
<span<?php echo $document_log->transmit_date_in_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub4->Visible) { // submit_no_sub4 ?>
		<td<?php echo $document_log->submit_no_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub4" class="document_log_submit_no_sub4">
<span<?php echo $document_log->submit_no_sub4->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub4->Visible) { // revision_no_sub4 ?>
		<td<?php echo $document_log->revision_no_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub4" class="document_log_revision_no_sub4">
<span<?php echo $document_log->revision_no_sub4->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub4->Visible) { // direction_out_sub4 ?>
		<td<?php echo $document_log->direction_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub4" class="document_log_direction_out_sub4">
<span<?php echo $document_log->direction_out_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub4->Visible) { // planned_date_out_sub4 ?>
		<td<?php echo $document_log->planned_date_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub4" class="document_log_planned_date_out_sub4">
<span<?php echo $document_log->planned_date_out_sub4->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub4->Visible) { // transmit_date_out_sub4 ?>
		<td<?php echo $document_log->transmit_date_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub4" class="document_log_transmit_date_out_sub4">
<span<?php echo $document_log->transmit_date_out_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub4->Visible) { // transmit_no_out_sub4 ?>
		<td<?php echo $document_log->transmit_no_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub4" class="document_log_transmit_no_out_sub4">
<span<?php echo $document_log->transmit_no_out_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub4->Visible) { // approval_status_out_sub4 ?>
		<td<?php echo $document_log->approval_status_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub4" class="document_log_approval_status_out_sub4">
<span<?php echo $document_log->approval_status_out_sub4->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub4->Visible) { // direction_in_sub4 ?>
		<td<?php echo $document_log->direction_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub4" class="document_log_direction_in_sub4">
<span<?php echo $document_log->direction_in_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub4->Visible) { // transmit_no_in_sub4 ?>
		<td<?php echo $document_log->transmit_no_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub4" class="document_log_transmit_no_in_sub4">
<span<?php echo $document_log->transmit_no_in_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub4->Visible) { // approval_status_in_sub4 ?>
		<td<?php echo $document_log->approval_status_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub4" class="document_log_approval_status_in_sub4">
<span<?php echo $document_log->approval_status_in_sub4->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_file_sub4->Visible) { // direction_in_file_sub4 ?>
		<td<?php echo $document_log->direction_in_file_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_file_sub4" class="document_log_direction_in_file_sub4">
<span<?php echo $document_log->direction_in_file_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub4->Visible) { // transmit_date_in_sub4 ?>
		<td<?php echo $document_log->transmit_date_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub4" class="document_log_transmit_date_in_sub4">
<span<?php echo $document_log->transmit_date_in_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub5->Visible) { // submit_no_sub5 ?>
		<td<?php echo $document_log->submit_no_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub5" class="document_log_submit_no_sub5">
<span<?php echo $document_log->submit_no_sub5->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub5->Visible) { // revision_no_sub5 ?>
		<td<?php echo $document_log->revision_no_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub5" class="document_log_revision_no_sub5">
<span<?php echo $document_log->revision_no_sub5->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub5->Visible) { // direction_out_sub5 ?>
		<td<?php echo $document_log->direction_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub5" class="document_log_direction_out_sub5">
<span<?php echo $document_log->direction_out_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub5->Visible) { // planned_date_out_sub5 ?>
		<td<?php echo $document_log->planned_date_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub5" class="document_log_planned_date_out_sub5">
<span<?php echo $document_log->planned_date_out_sub5->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub5->Visible) { // transmit_date_out_sub5 ?>
		<td<?php echo $document_log->transmit_date_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub5" class="document_log_transmit_date_out_sub5">
<span<?php echo $document_log->transmit_date_out_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub5->Visible) { // transmit_no_out_sub5 ?>
		<td<?php echo $document_log->transmit_no_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub5" class="document_log_transmit_no_out_sub5">
<span<?php echo $document_log->transmit_no_out_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub5->Visible) { // approval_status_out_sub5 ?>
		<td<?php echo $document_log->approval_status_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub5" class="document_log_approval_status_out_sub5">
<span<?php echo $document_log->approval_status_out_sub5->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub5->Visible) { // direction_in_sub5 ?>
		<td<?php echo $document_log->direction_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub5" class="document_log_direction_in_sub5">
<span<?php echo $document_log->direction_in_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub5->Visible) { // transmit_no_in_sub5 ?>
		<td<?php echo $document_log->transmit_no_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub5" class="document_log_transmit_no_in_sub5">
<span<?php echo $document_log->transmit_no_in_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub5->Visible) { // approval_status_in_sub5 ?>
		<td<?php echo $document_log->approval_status_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub5" class="document_log_approval_status_in_sub5">
<span<?php echo $document_log->approval_status_in_sub5->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_file_sub5->Visible) { // direction_in_file_sub5 ?>
		<td<?php echo $document_log->direction_in_file_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_file_sub5" class="document_log_direction_in_file_sub5">
<span<?php echo $document_log->direction_in_file_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub5->Visible) { // transmit_date_in_sub5 ?>
		<td<?php echo $document_log->transmit_date_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub5" class="document_log_transmit_date_in_sub5">
<span<?php echo $document_log->transmit_date_in_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub6->Visible) { // submit_no_sub6 ?>
		<td<?php echo $document_log->submit_no_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub6" class="document_log_submit_no_sub6">
<span<?php echo $document_log->submit_no_sub6->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub6->Visible) { // revision_no_sub6 ?>
		<td<?php echo $document_log->revision_no_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub6" class="document_log_revision_no_sub6">
<span<?php echo $document_log->revision_no_sub6->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub6->Visible) { // direction_out_sub6 ?>
		<td<?php echo $document_log->direction_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub6" class="document_log_direction_out_sub6">
<span<?php echo $document_log->direction_out_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub6->Visible) { // planned_date_out_sub6 ?>
		<td<?php echo $document_log->planned_date_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub6" class="document_log_planned_date_out_sub6">
<span<?php echo $document_log->planned_date_out_sub6->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub6->Visible) { // transmit_date_out_sub6 ?>
		<td<?php echo $document_log->transmit_date_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub6" class="document_log_transmit_date_out_sub6">
<span<?php echo $document_log->transmit_date_out_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub6->Visible) { // transmit_no_out_sub6 ?>
		<td<?php echo $document_log->transmit_no_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub6" class="document_log_transmit_no_out_sub6">
<span<?php echo $document_log->transmit_no_out_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub6->Visible) { // approval_status_out_sub6 ?>
		<td<?php echo $document_log->approval_status_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub6" class="document_log_approval_status_out_sub6">
<span<?php echo $document_log->approval_status_out_sub6->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub6->Visible) { // direction_in_sub6 ?>
		<td<?php echo $document_log->direction_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub6" class="document_log_direction_in_sub6">
<span<?php echo $document_log->direction_in_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub6->Visible) { // transmit_no_in_sub6 ?>
		<td<?php echo $document_log->transmit_no_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub6" class="document_log_transmit_no_in_sub6">
<span<?php echo $document_log->transmit_no_in_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub6->Visible) { // approval_status_in_sub6 ?>
		<td<?php echo $document_log->approval_status_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub6" class="document_log_approval_status_in_sub6">
<span<?php echo $document_log->approval_status_in_sub6->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_file_sub6->Visible) { // direction_in_file_sub6 ?>
		<td<?php echo $document_log->direction_in_file_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_file_sub6" class="document_log_direction_in_file_sub6">
<span<?php echo $document_log->direction_in_file_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub6->Visible) { // transmit_date_in_sub6 ?>
		<td<?php echo $document_log->transmit_date_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub6" class="document_log_transmit_date_in_sub6">
<span<?php echo $document_log->transmit_date_in_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub7->Visible) { // submit_no_sub7 ?>
		<td<?php echo $document_log->submit_no_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub7" class="document_log_submit_no_sub7">
<span<?php echo $document_log->submit_no_sub7->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub7->Visible) { // revision_no_sub7 ?>
		<td<?php echo $document_log->revision_no_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub7" class="document_log_revision_no_sub7">
<span<?php echo $document_log->revision_no_sub7->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub7->Visible) { // direction_out_sub7 ?>
		<td<?php echo $document_log->direction_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub7" class="document_log_direction_out_sub7">
<span<?php echo $document_log->direction_out_sub7->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub7->Visible) { // planned_date_out_sub7 ?>
		<td<?php echo $document_log->planned_date_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub7" class="document_log_planned_date_out_sub7">
<span<?php echo $document_log->planned_date_out_sub7->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub7->Visible) { // transmit_date_out_sub7 ?>
		<td<?php echo $document_log->transmit_date_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub7" class="document_log_transmit_date_out_sub7">
<span<?php echo $document_log->transmit_date_out_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub7->Visible) { // transmit_no_out_sub7 ?>
		<td<?php echo $document_log->transmit_no_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub7" class="document_log_transmit_no_out_sub7">
<span<?php echo $document_log->transmit_no_out_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub7->Visible) { // approval_status_out_sub7 ?>
		<td<?php echo $document_log->approval_status_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub7" class="document_log_approval_status_out_sub7">
<span<?php echo $document_log->approval_status_out_sub7->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub7->Visible) { // direction_in_sub7 ?>
		<td<?php echo $document_log->direction_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub7" class="document_log_direction_in_sub7">
<span<?php echo $document_log->direction_in_sub7->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub7->Visible) { // transmit_no_in_sub7 ?>
		<td<?php echo $document_log->transmit_no_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub7" class="document_log_transmit_no_in_sub7">
<span<?php echo $document_log->transmit_no_in_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub7->Visible) { // approval_status_in_sub7 ?>
		<td<?php echo $document_log->approval_status_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub7" class="document_log_approval_status_in_sub7">
<span<?php echo $document_log->approval_status_in_sub7->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub7->Visible) { // transmit_date_in_sub7 ?>
		<td<?php echo $document_log->transmit_date_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub7" class="document_log_transmit_date_in_sub7">
<span<?php echo $document_log->transmit_date_in_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub8->Visible) { // submit_no_sub8 ?>
		<td<?php echo $document_log->submit_no_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub8" class="document_log_submit_no_sub8">
<span<?php echo $document_log->submit_no_sub8->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub8->Visible) { // revision_no_sub8 ?>
		<td<?php echo $document_log->revision_no_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub8" class="document_log_revision_no_sub8">
<span<?php echo $document_log->revision_no_sub8->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub8->Visible) { // direction_out_sub8 ?>
		<td<?php echo $document_log->direction_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub8" class="document_log_direction_out_sub8">
<span<?php echo $document_log->direction_out_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub8->Visible) { // planned_date_out_sub8 ?>
		<td<?php echo $document_log->planned_date_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub8" class="document_log_planned_date_out_sub8">
<span<?php echo $document_log->planned_date_out_sub8->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub8->Visible) { // transmit_date_out_sub8 ?>
		<td<?php echo $document_log->transmit_date_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub8" class="document_log_transmit_date_out_sub8">
<span<?php echo $document_log->transmit_date_out_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub8->Visible) { // transmit_no_out_sub8 ?>
		<td<?php echo $document_log->transmit_no_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub8" class="document_log_transmit_no_out_sub8">
<span<?php echo $document_log->transmit_no_out_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub8->Visible) { // approval_status_out_sub8 ?>
		<td<?php echo $document_log->approval_status_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub8" class="document_log_approval_status_out_sub8">
<span<?php echo $document_log->approval_status_out_sub8->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_file_sub8->Visible) { // direction_out_file_sub8 ?>
		<td<?php echo $document_log->direction_out_file_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_file_sub8" class="document_log_direction_out_file_sub8">
<span<?php echo $document_log->direction_out_file_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_out_file_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub8->Visible) { // direction_in_sub8 ?>
		<td<?php echo $document_log->direction_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub8" class="document_log_direction_in_sub8">
<span<?php echo $document_log->direction_in_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub8->Visible) { // transmit_no_in_sub8 ?>
		<td<?php echo $document_log->transmit_no_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub8" class="document_log_transmit_no_in_sub8">
<span<?php echo $document_log->transmit_no_in_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub8->Visible) { // approval_status_in_sub8 ?>
		<td<?php echo $document_log->approval_status_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub8" class="document_log_approval_status_in_sub8">
<span<?php echo $document_log->approval_status_in_sub8->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub8->Visible) { // transmit_date_in_sub8 ?>
		<td<?php echo $document_log->transmit_date_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub8" class="document_log_transmit_date_in_sub8">
<span<?php echo $document_log->transmit_date_in_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub9->Visible) { // submit_no_sub9 ?>
		<td<?php echo $document_log->submit_no_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub9" class="document_log_submit_no_sub9">
<span<?php echo $document_log->submit_no_sub9->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub9->Visible) { // revision_no_sub9 ?>
		<td<?php echo $document_log->revision_no_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub9" class="document_log_revision_no_sub9">
<span<?php echo $document_log->revision_no_sub9->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub9->Visible) { // direction_out_sub9 ?>
		<td<?php echo $document_log->direction_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub9" class="document_log_direction_out_sub9">
<span<?php echo $document_log->direction_out_sub9->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub9->Visible) { // planned_date_out_sub9 ?>
		<td<?php echo $document_log->planned_date_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub9" class="document_log_planned_date_out_sub9">
<span<?php echo $document_log->planned_date_out_sub9->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub9->Visible) { // transmit_date_out_sub9 ?>
		<td<?php echo $document_log->transmit_date_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub9" class="document_log_transmit_date_out_sub9">
<span<?php echo $document_log->transmit_date_out_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub9->Visible) { // transmit_no_out_sub9 ?>
		<td<?php echo $document_log->transmit_no_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub9" class="document_log_transmit_no_out_sub9">
<span<?php echo $document_log->transmit_no_out_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub9->Visible) { // approval_status_out_sub9 ?>
		<td<?php echo $document_log->approval_status_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub9" class="document_log_approval_status_out_sub9">
<span<?php echo $document_log->approval_status_out_sub9->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub9->Visible) { // direction_in_sub9 ?>
		<td<?php echo $document_log->direction_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub9" class="document_log_direction_in_sub9">
<span<?php echo $document_log->direction_in_sub9->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub9->Visible) { // transmit_no_in_sub9 ?>
		<td<?php echo $document_log->transmit_no_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub9" class="document_log_transmit_no_in_sub9">
<span<?php echo $document_log->transmit_no_in_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub9->Visible) { // approval_status_in_sub9 ?>
		<td<?php echo $document_log->approval_status_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub9" class="document_log_approval_status_in_sub9">
<span<?php echo $document_log->approval_status_in_sub9->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub9->Visible) { // transmit_date_in_sub9 ?>
		<td<?php echo $document_log->transmit_date_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub9" class="document_log_transmit_date_in_sub9">
<span<?php echo $document_log->transmit_date_in_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_sub10->Visible) { // submit_no_sub10 ?>
		<td<?php echo $document_log->submit_no_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_sub10" class="document_log_submit_no_sub10">
<span<?php echo $document_log->submit_no_sub10->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_sub10->Visible) { // revision_no_sub10 ?>
		<td<?php echo $document_log->revision_no_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_sub10" class="document_log_revision_no_sub10">
<span<?php echo $document_log->revision_no_sub10->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_out_sub10->Visible) { // direction_out_sub10 ?>
		<td<?php echo $document_log->direction_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_out_sub10" class="document_log_direction_out_sub10">
<span<?php echo $document_log->direction_out_sub10->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_out_sub10->Visible) { // planned_date_out_sub10 ?>
		<td<?php echo $document_log->planned_date_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_out_sub10" class="document_log_planned_date_out_sub10">
<span<?php echo $document_log->planned_date_out_sub10->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub10->Visible) { // transmit_date_out_sub10 ?>
		<td<?php echo $document_log->transmit_date_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_out_sub10" class="document_log_transmit_date_out_sub10">
<span<?php echo $document_log->transmit_date_out_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub10->Visible) { // transmit_no_out_sub10 ?>
		<td<?php echo $document_log->transmit_no_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_out_sub10" class="document_log_transmit_no_out_sub10">
<span<?php echo $document_log->transmit_no_out_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_out_sub10->Visible) { // approval_status_out_sub10 ?>
		<td<?php echo $document_log->approval_status_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_out_sub10" class="document_log_approval_status_out_sub10">
<span<?php echo $document_log->approval_status_out_sub10->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_in_sub10->Visible) { // direction_in_sub10 ?>
		<td<?php echo $document_log->direction_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_in_sub10" class="document_log_direction_in_sub10">
<span<?php echo $document_log->direction_in_sub10->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub10->Visible) { // transmit_no_in_sub10 ?>
		<td<?php echo $document_log->transmit_no_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_in_sub10" class="document_log_transmit_no_in_sub10">
<span<?php echo $document_log->transmit_no_in_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_in_sub10->Visible) { // approval_status_in_sub10 ?>
		<td<?php echo $document_log->approval_status_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_in_sub10" class="document_log_approval_status_in_sub10">
<span<?php echo $document_log->approval_status_in_sub10->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub10->Visible) { // transmit_date_in_sub10 ?>
		<td<?php echo $document_log->transmit_date_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_in_sub10" class="document_log_transmit_date_in_sub10">
<span<?php echo $document_log->transmit_date_in_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
		<td<?php echo $document_log->log_updatedon->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_log_updatedon" class="document_log_log_updatedon">
<span<?php echo $document_log->log_updatedon->viewAttributes() ?>>
<?php echo $document_log->log_updatedon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$document_log_delete->Recordset->moveNext();
}
$document_log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_log_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$document_log_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_log_delete->terminate();
?>