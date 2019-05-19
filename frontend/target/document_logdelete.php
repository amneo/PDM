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
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
		<th class="<?php echo $document_log->client_doc_no->headerCellClass() ?>"><span id="elh_document_log_client_doc_no" class="document_log_client_doc_no"><?php echo $document_log->client_doc_no->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
		<th class="<?php echo $document_log->order_number->headerCellClass() ?>"><span id="elh_document_log_order_number" class="document_log_order_number"><?php echo $document_log->order_number->caption() ?></span></th>
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
<?php if ($document_log->submit_no_1->Visible) { // submit_no_1 ?>
		<th class="<?php echo $document_log->submit_no_1->headerCellClass() ?>"><span id="elh_document_log_submit_no_1" class="document_log_submit_no_1"><?php echo $document_log->submit_no_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_1->Visible) { // revision_no_1 ?>
		<th class="<?php echo $document_log->revision_no_1->headerCellClass() ?>"><span id="elh_document_log_revision_no_1" class="document_log_revision_no_1"><?php echo $document_log->revision_no_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_1->Visible) { // direction_1 ?>
		<th class="<?php echo $document_log->direction_1->headerCellClass() ?>"><span id="elh_document_log_direction_1" class="document_log_direction_1"><?php echo $document_log->direction_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_1->Visible) { // planned_date_1 ?>
		<th class="<?php echo $document_log->planned_date_1->headerCellClass() ?>"><span id="elh_document_log_planned_date_1" class="document_log_planned_date_1"><?php echo $document_log->planned_date_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_1->Visible) { // transmit_date_1 ?>
		<th class="<?php echo $document_log->transmit_date_1->headerCellClass() ?>"><span id="elh_document_log_transmit_date_1" class="document_log_transmit_date_1"><?php echo $document_log->transmit_date_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_1->Visible) { // transmit_no_1 ?>
		<th class="<?php echo $document_log->transmit_no_1->headerCellClass() ?>"><span id="elh_document_log_transmit_no_1" class="document_log_transmit_no_1"><?php echo $document_log->transmit_no_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_1->Visible) { // approval_status_1 ?>
		<th class="<?php echo $document_log->approval_status_1->headerCellClass() ?>"><span id="elh_document_log_approval_status_1" class="document_log_approval_status_1"><?php echo $document_log->approval_status_1->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_2->Visible) { // submit_no_2 ?>
		<th class="<?php echo $document_log->submit_no_2->headerCellClass() ?>"><span id="elh_document_log_submit_no_2" class="document_log_submit_no_2"><?php echo $document_log->submit_no_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_2->Visible) { // revision_no_2 ?>
		<th class="<?php echo $document_log->revision_no_2->headerCellClass() ?>"><span id="elh_document_log_revision_no_2" class="document_log_revision_no_2"><?php echo $document_log->revision_no_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_2->Visible) { // direction_2 ?>
		<th class="<?php echo $document_log->direction_2->headerCellClass() ?>"><span id="elh_document_log_direction_2" class="document_log_direction_2"><?php echo $document_log->direction_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_2->Visible) { // planned_date_2 ?>
		<th class="<?php echo $document_log->planned_date_2->headerCellClass() ?>"><span id="elh_document_log_planned_date_2" class="document_log_planned_date_2"><?php echo $document_log->planned_date_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_2->Visible) { // transmit_date_2 ?>
		<th class="<?php echo $document_log->transmit_date_2->headerCellClass() ?>"><span id="elh_document_log_transmit_date_2" class="document_log_transmit_date_2"><?php echo $document_log->transmit_date_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_2->Visible) { // transmit_no_2 ?>
		<th class="<?php echo $document_log->transmit_no_2->headerCellClass() ?>"><span id="elh_document_log_transmit_no_2" class="document_log_transmit_no_2"><?php echo $document_log->transmit_no_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_2->Visible) { // approval_status_2 ?>
		<th class="<?php echo $document_log->approval_status_2->headerCellClass() ?>"><span id="elh_document_log_approval_status_2" class="document_log_approval_status_2"><?php echo $document_log->approval_status_2->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_3->Visible) { // submit_no_3 ?>
		<th class="<?php echo $document_log->submit_no_3->headerCellClass() ?>"><span id="elh_document_log_submit_no_3" class="document_log_submit_no_3"><?php echo $document_log->submit_no_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_3->Visible) { // revision_no_3 ?>
		<th class="<?php echo $document_log->revision_no_3->headerCellClass() ?>"><span id="elh_document_log_revision_no_3" class="document_log_revision_no_3"><?php echo $document_log->revision_no_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_3->Visible) { // direction_3 ?>
		<th class="<?php echo $document_log->direction_3->headerCellClass() ?>"><span id="elh_document_log_direction_3" class="document_log_direction_3"><?php echo $document_log->direction_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_3->Visible) { // planned_date_3 ?>
		<th class="<?php echo $document_log->planned_date_3->headerCellClass() ?>"><span id="elh_document_log_planned_date_3" class="document_log_planned_date_3"><?php echo $document_log->planned_date_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_3->Visible) { // transmit_date_3 ?>
		<th class="<?php echo $document_log->transmit_date_3->headerCellClass() ?>"><span id="elh_document_log_transmit_date_3" class="document_log_transmit_date_3"><?php echo $document_log->transmit_date_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_3->Visible) { // transmit_no_3 ?>
		<th class="<?php echo $document_log->transmit_no_3->headerCellClass() ?>"><span id="elh_document_log_transmit_no_3" class="document_log_transmit_no_3"><?php echo $document_log->transmit_no_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_3->Visible) { // approval_status_3 ?>
		<th class="<?php echo $document_log->approval_status_3->headerCellClass() ?>"><span id="elh_document_log_approval_status_3" class="document_log_approval_status_3"><?php echo $document_log->approval_status_3->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_4->Visible) { // submit_no_4 ?>
		<th class="<?php echo $document_log->submit_no_4->headerCellClass() ?>"><span id="elh_document_log_submit_no_4" class="document_log_submit_no_4"><?php echo $document_log->submit_no_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_4->Visible) { // revision_no_4 ?>
		<th class="<?php echo $document_log->revision_no_4->headerCellClass() ?>"><span id="elh_document_log_revision_no_4" class="document_log_revision_no_4"><?php echo $document_log->revision_no_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_4->Visible) { // direction_4 ?>
		<th class="<?php echo $document_log->direction_4->headerCellClass() ?>"><span id="elh_document_log_direction_4" class="document_log_direction_4"><?php echo $document_log->direction_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_4->Visible) { // planned_date_4 ?>
		<th class="<?php echo $document_log->planned_date_4->headerCellClass() ?>"><span id="elh_document_log_planned_date_4" class="document_log_planned_date_4"><?php echo $document_log->planned_date_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_4->Visible) { // transmit_date_4 ?>
		<th class="<?php echo $document_log->transmit_date_4->headerCellClass() ?>"><span id="elh_document_log_transmit_date_4" class="document_log_transmit_date_4"><?php echo $document_log->transmit_date_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_4->Visible) { // transmit_no_4 ?>
		<th class="<?php echo $document_log->transmit_no_4->headerCellClass() ?>"><span id="elh_document_log_transmit_no_4" class="document_log_transmit_no_4"><?php echo $document_log->transmit_no_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_4->Visible) { // approval_status_4 ?>
		<th class="<?php echo $document_log->approval_status_4->headerCellClass() ?>"><span id="elh_document_log_approval_status_4" class="document_log_approval_status_4"><?php echo $document_log->approval_status_4->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_5->Visible) { // submit_no_5 ?>
		<th class="<?php echo $document_log->submit_no_5->headerCellClass() ?>"><span id="elh_document_log_submit_no_5" class="document_log_submit_no_5"><?php echo $document_log->submit_no_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_5->Visible) { // revision_no_5 ?>
		<th class="<?php echo $document_log->revision_no_5->headerCellClass() ?>"><span id="elh_document_log_revision_no_5" class="document_log_revision_no_5"><?php echo $document_log->revision_no_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_5->Visible) { // direction_5 ?>
		<th class="<?php echo $document_log->direction_5->headerCellClass() ?>"><span id="elh_document_log_direction_5" class="document_log_direction_5"><?php echo $document_log->direction_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_5->Visible) { // planned_date_5 ?>
		<th class="<?php echo $document_log->planned_date_5->headerCellClass() ?>"><span id="elh_document_log_planned_date_5" class="document_log_planned_date_5"><?php echo $document_log->planned_date_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_5->Visible) { // transmit_date_5 ?>
		<th class="<?php echo $document_log->transmit_date_5->headerCellClass() ?>"><span id="elh_document_log_transmit_date_5" class="document_log_transmit_date_5"><?php echo $document_log->transmit_date_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_5->Visible) { // transmit_no_5 ?>
		<th class="<?php echo $document_log->transmit_no_5->headerCellClass() ?>"><span id="elh_document_log_transmit_no_5" class="document_log_transmit_no_5"><?php echo $document_log->transmit_no_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_5->Visible) { // approval_status_5 ?>
		<th class="<?php echo $document_log->approval_status_5->headerCellClass() ?>"><span id="elh_document_log_approval_status_5" class="document_log_approval_status_5"><?php echo $document_log->approval_status_5->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_6->Visible) { // submit_no_6 ?>
		<th class="<?php echo $document_log->submit_no_6->headerCellClass() ?>"><span id="elh_document_log_submit_no_6" class="document_log_submit_no_6"><?php echo $document_log->submit_no_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_6->Visible) { // revision_no_6 ?>
		<th class="<?php echo $document_log->revision_no_6->headerCellClass() ?>"><span id="elh_document_log_revision_no_6" class="document_log_revision_no_6"><?php echo $document_log->revision_no_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_6->Visible) { // direction_6 ?>
		<th class="<?php echo $document_log->direction_6->headerCellClass() ?>"><span id="elh_document_log_direction_6" class="document_log_direction_6"><?php echo $document_log->direction_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_6->Visible) { // planned_date_6 ?>
		<th class="<?php echo $document_log->planned_date_6->headerCellClass() ?>"><span id="elh_document_log_planned_date_6" class="document_log_planned_date_6"><?php echo $document_log->planned_date_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_6->Visible) { // transmit_date_6 ?>
		<th class="<?php echo $document_log->transmit_date_6->headerCellClass() ?>"><span id="elh_document_log_transmit_date_6" class="document_log_transmit_date_6"><?php echo $document_log->transmit_date_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_6->Visible) { // transmit_no_6 ?>
		<th class="<?php echo $document_log->transmit_no_6->headerCellClass() ?>"><span id="elh_document_log_transmit_no_6" class="document_log_transmit_no_6"><?php echo $document_log->transmit_no_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_6->Visible) { // approval_status_6 ?>
		<th class="<?php echo $document_log->approval_status_6->headerCellClass() ?>"><span id="elh_document_log_approval_status_6" class="document_log_approval_status_6"><?php echo $document_log->approval_status_6->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_7->Visible) { // submit_no_7 ?>
		<th class="<?php echo $document_log->submit_no_7->headerCellClass() ?>"><span id="elh_document_log_submit_no_7" class="document_log_submit_no_7"><?php echo $document_log->submit_no_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_7->Visible) { // revision_no_7 ?>
		<th class="<?php echo $document_log->revision_no_7->headerCellClass() ?>"><span id="elh_document_log_revision_no_7" class="document_log_revision_no_7"><?php echo $document_log->revision_no_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_7->Visible) { // direction_7 ?>
		<th class="<?php echo $document_log->direction_7->headerCellClass() ?>"><span id="elh_document_log_direction_7" class="document_log_direction_7"><?php echo $document_log->direction_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_7->Visible) { // planned_date_7 ?>
		<th class="<?php echo $document_log->planned_date_7->headerCellClass() ?>"><span id="elh_document_log_planned_date_7" class="document_log_planned_date_7"><?php echo $document_log->planned_date_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_7->Visible) { // transmit_date_7 ?>
		<th class="<?php echo $document_log->transmit_date_7->headerCellClass() ?>"><span id="elh_document_log_transmit_date_7" class="document_log_transmit_date_7"><?php echo $document_log->transmit_date_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_7->Visible) { // transmit_no_7 ?>
		<th class="<?php echo $document_log->transmit_no_7->headerCellClass() ?>"><span id="elh_document_log_transmit_no_7" class="document_log_transmit_no_7"><?php echo $document_log->transmit_no_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_7->Visible) { // approval_status_7 ?>
		<th class="<?php echo $document_log->approval_status_7->headerCellClass() ?>"><span id="elh_document_log_approval_status_7" class="document_log_approval_status_7"><?php echo $document_log->approval_status_7->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_8->Visible) { // submit_no_8 ?>
		<th class="<?php echo $document_log->submit_no_8->headerCellClass() ?>"><span id="elh_document_log_submit_no_8" class="document_log_submit_no_8"><?php echo $document_log->submit_no_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_8->Visible) { // revision_no_8 ?>
		<th class="<?php echo $document_log->revision_no_8->headerCellClass() ?>"><span id="elh_document_log_revision_no_8" class="document_log_revision_no_8"><?php echo $document_log->revision_no_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_8->Visible) { // direction_8 ?>
		<th class="<?php echo $document_log->direction_8->headerCellClass() ?>"><span id="elh_document_log_direction_8" class="document_log_direction_8"><?php echo $document_log->direction_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_8->Visible) { // planned_date_8 ?>
		<th class="<?php echo $document_log->planned_date_8->headerCellClass() ?>"><span id="elh_document_log_planned_date_8" class="document_log_planned_date_8"><?php echo $document_log->planned_date_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_8->Visible) { // transmit_date_8 ?>
		<th class="<?php echo $document_log->transmit_date_8->headerCellClass() ?>"><span id="elh_document_log_transmit_date_8" class="document_log_transmit_date_8"><?php echo $document_log->transmit_date_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_8->Visible) { // transmit_no_8 ?>
		<th class="<?php echo $document_log->transmit_no_8->headerCellClass() ?>"><span id="elh_document_log_transmit_no_8" class="document_log_transmit_no_8"><?php echo $document_log->transmit_no_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_8->Visible) { // approval_status_8 ?>
		<th class="<?php echo $document_log->approval_status_8->headerCellClass() ?>"><span id="elh_document_log_approval_status_8" class="document_log_approval_status_8"><?php echo $document_log->approval_status_8->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_9->Visible) { // submit_no_9 ?>
		<th class="<?php echo $document_log->submit_no_9->headerCellClass() ?>"><span id="elh_document_log_submit_no_9" class="document_log_submit_no_9"><?php echo $document_log->submit_no_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_9->Visible) { // revision_no_9 ?>
		<th class="<?php echo $document_log->revision_no_9->headerCellClass() ?>"><span id="elh_document_log_revision_no_9" class="document_log_revision_no_9"><?php echo $document_log->revision_no_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_9->Visible) { // direction_9 ?>
		<th class="<?php echo $document_log->direction_9->headerCellClass() ?>"><span id="elh_document_log_direction_9" class="document_log_direction_9"><?php echo $document_log->direction_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_9->Visible) { // planned_date_9 ?>
		<th class="<?php echo $document_log->planned_date_9->headerCellClass() ?>"><span id="elh_document_log_planned_date_9" class="document_log_planned_date_9"><?php echo $document_log->planned_date_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_9->Visible) { // transmit_date_9 ?>
		<th class="<?php echo $document_log->transmit_date_9->headerCellClass() ?>"><span id="elh_document_log_transmit_date_9" class="document_log_transmit_date_9"><?php echo $document_log->transmit_date_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_9->Visible) { // transmit_no_9 ?>
		<th class="<?php echo $document_log->transmit_no_9->headerCellClass() ?>"><span id="elh_document_log_transmit_no_9" class="document_log_transmit_no_9"><?php echo $document_log->transmit_no_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_9->Visible) { // approval_status_9 ?>
		<th class="<?php echo $document_log->approval_status_9->headerCellClass() ?>"><span id="elh_document_log_approval_status_9" class="document_log_approval_status_9"><?php echo $document_log->approval_status_9->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->submit_no_10->Visible) { // submit_no_10 ?>
		<th class="<?php echo $document_log->submit_no_10->headerCellClass() ?>"><span id="elh_document_log_submit_no_10" class="document_log_submit_no_10"><?php echo $document_log->submit_no_10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->revision_no_10->Visible) { // revision_no_10 ?>
		<th class="<?php echo $document_log->revision_no_10->headerCellClass() ?>"><span id="elh_document_log_revision_no_10" class="document_log_revision_no_10"><?php echo $document_log->revision_no_10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->direction_10->Visible) { // direction_10 ?>
		<th class="<?php echo $document_log->direction_10->headerCellClass() ?>"><span id="elh_document_log_direction_10" class="document_log_direction_10"><?php echo $document_log->direction_10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->planned_date_10->Visible) { // planned_date_10 ?>
		<th class="<?php echo $document_log->planned_date_10->headerCellClass() ?>"><span id="elh_document_log_planned_date_10" class="document_log_planned_date_10"><?php echo $document_log->planned_date_10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_date_10->Visible) { // transmit_date_10 ?>
		<th class="<?php echo $document_log->transmit_date_10->headerCellClass() ?>"><span id="elh_document_log_transmit_date_10" class="document_log_transmit_date_10"><?php echo $document_log->transmit_date_10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->transmit_no_10->Visible) { // transmit_no_10 ?>
		<th class="<?php echo $document_log->transmit_no_10->headerCellClass() ?>"><span id="elh_document_log_transmit_no_10" class="document_log_transmit_no_10"><?php echo $document_log->transmit_no_10->caption() ?></span></th>
<?php } ?>
<?php if ($document_log->approval_status_10->Visible) { // approval_status_10 ?>
		<th class="<?php echo $document_log->approval_status_10->headerCellClass() ?>"><span id="elh_document_log_approval_status_10" class="document_log_approval_status_10"><?php echo $document_log->approval_status_10->caption() ?></span></th>
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
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
		<td<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_client_doc_no" class="document_log_client_doc_no">
<span<?php echo $document_log->client_doc_no->viewAttributes() ?>>
<?php echo $document_log->client_doc_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
		<td<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_order_number" class="document_log_order_number">
<span<?php echo $document_log->order_number->viewAttributes() ?>>
<?php echo $document_log->order_number->getViewValue() ?></span>
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
<?php if ((!EmptyString($document_log->current_status->getViewValue())) && $document_log->current_status->linkAttributes() <> "") { ?>
<a<?php echo $document_log->current_status->linkAttributes() ?>><?php echo $document_log->current_status->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->current_status->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_1->Visible) { // submit_no_1 ?>
		<td<?php echo $document_log->submit_no_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_1" class="document_log_submit_no_1">
<span<?php echo $document_log->submit_no_1->viewAttributes() ?>>
<?php echo $document_log->submit_no_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_1->Visible) { // revision_no_1 ?>
		<td<?php echo $document_log->revision_no_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_1" class="document_log_revision_no_1">
<span<?php echo $document_log->revision_no_1->viewAttributes() ?>>
<?php echo $document_log->revision_no_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_1->Visible) { // direction_1 ?>
		<td<?php echo $document_log->direction_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_1" class="document_log_direction_1">
<span<?php echo $document_log->direction_1->viewAttributes() ?>>
<?php echo $document_log->direction_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_1->Visible) { // planned_date_1 ?>
		<td<?php echo $document_log->planned_date_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_1" class="document_log_planned_date_1">
<span<?php echo $document_log->planned_date_1->viewAttributes() ?>>
<?php echo $document_log->planned_date_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_1->Visible) { // transmit_date_1 ?>
		<td<?php echo $document_log->transmit_date_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_1" class="document_log_transmit_date_1">
<span<?php echo $document_log->transmit_date_1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_1->Visible) { // transmit_no_1 ?>
		<td<?php echo $document_log->transmit_no_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_1" class="document_log_transmit_no_1">
<span<?php echo $document_log->transmit_no_1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_1->Visible) { // approval_status_1 ?>
		<td<?php echo $document_log->approval_status_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_1" class="document_log_approval_status_1">
<span<?php echo $document_log->approval_status_1->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_1->getViewValue())) && $document_log->approval_status_1->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_1->linkAttributes() ?>><?php echo $document_log->approval_status_1->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_1->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_2->Visible) { // submit_no_2 ?>
		<td<?php echo $document_log->submit_no_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_2" class="document_log_submit_no_2">
<span<?php echo $document_log->submit_no_2->viewAttributes() ?>>
<?php echo $document_log->submit_no_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_2->Visible) { // revision_no_2 ?>
		<td<?php echo $document_log->revision_no_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_2" class="document_log_revision_no_2">
<span<?php echo $document_log->revision_no_2->viewAttributes() ?>>
<?php echo $document_log->revision_no_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_2->Visible) { // direction_2 ?>
		<td<?php echo $document_log->direction_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_2" class="document_log_direction_2">
<span<?php echo $document_log->direction_2->viewAttributes() ?>>
<?php echo $document_log->direction_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_2->Visible) { // planned_date_2 ?>
		<td<?php echo $document_log->planned_date_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_2" class="document_log_planned_date_2">
<span<?php echo $document_log->planned_date_2->viewAttributes() ?>>
<?php echo $document_log->planned_date_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_2->Visible) { // transmit_date_2 ?>
		<td<?php echo $document_log->transmit_date_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_2" class="document_log_transmit_date_2">
<span<?php echo $document_log->transmit_date_2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_2->Visible) { // transmit_no_2 ?>
		<td<?php echo $document_log->transmit_no_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_2" class="document_log_transmit_no_2">
<span<?php echo $document_log->transmit_no_2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_2->Visible) { // approval_status_2 ?>
		<td<?php echo $document_log->approval_status_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_2" class="document_log_approval_status_2">
<span<?php echo $document_log->approval_status_2->viewAttributes() ?>>
<?php echo $document_log->approval_status_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_3->Visible) { // submit_no_3 ?>
		<td<?php echo $document_log->submit_no_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_3" class="document_log_submit_no_3">
<span<?php echo $document_log->submit_no_3->viewAttributes() ?>>
<?php echo $document_log->submit_no_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_3->Visible) { // revision_no_3 ?>
		<td<?php echo $document_log->revision_no_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_3" class="document_log_revision_no_3">
<span<?php echo $document_log->revision_no_3->viewAttributes() ?>>
<?php echo $document_log->revision_no_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_3->Visible) { // direction_3 ?>
		<td<?php echo $document_log->direction_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_3" class="document_log_direction_3">
<span<?php echo $document_log->direction_3->viewAttributes() ?>>
<?php echo $document_log->direction_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_3->Visible) { // planned_date_3 ?>
		<td<?php echo $document_log->planned_date_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_3" class="document_log_planned_date_3">
<span<?php echo $document_log->planned_date_3->viewAttributes() ?>>
<?php echo $document_log->planned_date_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_3->Visible) { // transmit_date_3 ?>
		<td<?php echo $document_log->transmit_date_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_3" class="document_log_transmit_date_3">
<span<?php echo $document_log->transmit_date_3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_3->Visible) { // transmit_no_3 ?>
		<td<?php echo $document_log->transmit_no_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_3" class="document_log_transmit_no_3">
<span<?php echo $document_log->transmit_no_3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_3->Visible) { // approval_status_3 ?>
		<td<?php echo $document_log->approval_status_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_3" class="document_log_approval_status_3">
<span<?php echo $document_log->approval_status_3->viewAttributes() ?>>
<?php echo $document_log->approval_status_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_4->Visible) { // submit_no_4 ?>
		<td<?php echo $document_log->submit_no_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_4" class="document_log_submit_no_4">
<span<?php echo $document_log->submit_no_4->viewAttributes() ?>>
<?php echo $document_log->submit_no_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_4->Visible) { // revision_no_4 ?>
		<td<?php echo $document_log->revision_no_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_4" class="document_log_revision_no_4">
<span<?php echo $document_log->revision_no_4->viewAttributes() ?>>
<?php echo $document_log->revision_no_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_4->Visible) { // direction_4 ?>
		<td<?php echo $document_log->direction_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_4" class="document_log_direction_4">
<span<?php echo $document_log->direction_4->viewAttributes() ?>>
<?php echo $document_log->direction_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_4->Visible) { // planned_date_4 ?>
		<td<?php echo $document_log->planned_date_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_4" class="document_log_planned_date_4">
<span<?php echo $document_log->planned_date_4->viewAttributes() ?>>
<?php echo $document_log->planned_date_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_4->Visible) { // transmit_date_4 ?>
		<td<?php echo $document_log->transmit_date_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_4" class="document_log_transmit_date_4">
<span<?php echo $document_log->transmit_date_4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_4->Visible) { // transmit_no_4 ?>
		<td<?php echo $document_log->transmit_no_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_4" class="document_log_transmit_no_4">
<span<?php echo $document_log->transmit_no_4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_4->Visible) { // approval_status_4 ?>
		<td<?php echo $document_log->approval_status_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_4" class="document_log_approval_status_4">
<span<?php echo $document_log->approval_status_4->viewAttributes() ?>>
<?php echo $document_log->approval_status_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_5->Visible) { // submit_no_5 ?>
		<td<?php echo $document_log->submit_no_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_5" class="document_log_submit_no_5">
<span<?php echo $document_log->submit_no_5->viewAttributes() ?>>
<?php echo $document_log->submit_no_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_5->Visible) { // revision_no_5 ?>
		<td<?php echo $document_log->revision_no_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_5" class="document_log_revision_no_5">
<span<?php echo $document_log->revision_no_5->viewAttributes() ?>>
<?php echo $document_log->revision_no_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_5->Visible) { // direction_5 ?>
		<td<?php echo $document_log->direction_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_5" class="document_log_direction_5">
<span<?php echo $document_log->direction_5->viewAttributes() ?>>
<?php echo $document_log->direction_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_5->Visible) { // planned_date_5 ?>
		<td<?php echo $document_log->planned_date_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_5" class="document_log_planned_date_5">
<span<?php echo $document_log->planned_date_5->viewAttributes() ?>>
<?php echo $document_log->planned_date_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_5->Visible) { // transmit_date_5 ?>
		<td<?php echo $document_log->transmit_date_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_5" class="document_log_transmit_date_5">
<span<?php echo $document_log->transmit_date_5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_5->Visible) { // transmit_no_5 ?>
		<td<?php echo $document_log->transmit_no_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_5" class="document_log_transmit_no_5">
<span<?php echo $document_log->transmit_no_5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_5->Visible) { // approval_status_5 ?>
		<td<?php echo $document_log->approval_status_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_5" class="document_log_approval_status_5">
<span<?php echo $document_log->approval_status_5->viewAttributes() ?>>
<?php echo $document_log->approval_status_5->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_6->Visible) { // submit_no_6 ?>
		<td<?php echo $document_log->submit_no_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_6" class="document_log_submit_no_6">
<span<?php echo $document_log->submit_no_6->viewAttributes() ?>>
<?php echo $document_log->submit_no_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_6->Visible) { // revision_no_6 ?>
		<td<?php echo $document_log->revision_no_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_6" class="document_log_revision_no_6">
<span<?php echo $document_log->revision_no_6->viewAttributes() ?>>
<?php echo $document_log->revision_no_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_6->Visible) { // direction_6 ?>
		<td<?php echo $document_log->direction_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_6" class="document_log_direction_6">
<span<?php echo $document_log->direction_6->viewAttributes() ?>>
<?php echo $document_log->direction_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_6->Visible) { // planned_date_6 ?>
		<td<?php echo $document_log->planned_date_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_6" class="document_log_planned_date_6">
<span<?php echo $document_log->planned_date_6->viewAttributes() ?>>
<?php echo $document_log->planned_date_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_6->Visible) { // transmit_date_6 ?>
		<td<?php echo $document_log->transmit_date_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_6" class="document_log_transmit_date_6">
<span<?php echo $document_log->transmit_date_6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_6->Visible) { // transmit_no_6 ?>
		<td<?php echo $document_log->transmit_no_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_6" class="document_log_transmit_no_6">
<span<?php echo $document_log->transmit_no_6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_6->Visible) { // approval_status_6 ?>
		<td<?php echo $document_log->approval_status_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_6" class="document_log_approval_status_6">
<span<?php echo $document_log->approval_status_6->viewAttributes() ?>>
<?php echo $document_log->approval_status_6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_7->Visible) { // submit_no_7 ?>
		<td<?php echo $document_log->submit_no_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_7" class="document_log_submit_no_7">
<span<?php echo $document_log->submit_no_7->viewAttributes() ?>>
<?php echo $document_log->submit_no_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_7->Visible) { // revision_no_7 ?>
		<td<?php echo $document_log->revision_no_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_7" class="document_log_revision_no_7">
<span<?php echo $document_log->revision_no_7->viewAttributes() ?>>
<?php echo $document_log->revision_no_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_7->Visible) { // direction_7 ?>
		<td<?php echo $document_log->direction_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_7" class="document_log_direction_7">
<span<?php echo $document_log->direction_7->viewAttributes() ?>>
<?php echo $document_log->direction_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_7->Visible) { // planned_date_7 ?>
		<td<?php echo $document_log->planned_date_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_7" class="document_log_planned_date_7">
<span<?php echo $document_log->planned_date_7->viewAttributes() ?>>
<?php echo $document_log->planned_date_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_7->Visible) { // transmit_date_7 ?>
		<td<?php echo $document_log->transmit_date_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_7" class="document_log_transmit_date_7">
<span<?php echo $document_log->transmit_date_7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_7->Visible) { // transmit_no_7 ?>
		<td<?php echo $document_log->transmit_no_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_7" class="document_log_transmit_no_7">
<span<?php echo $document_log->transmit_no_7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_7->Visible) { // approval_status_7 ?>
		<td<?php echo $document_log->approval_status_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_7" class="document_log_approval_status_7">
<span<?php echo $document_log->approval_status_7->viewAttributes() ?>>
<?php echo $document_log->approval_status_7->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_8->Visible) { // submit_no_8 ?>
		<td<?php echo $document_log->submit_no_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_8" class="document_log_submit_no_8">
<span<?php echo $document_log->submit_no_8->viewAttributes() ?>>
<?php echo $document_log->submit_no_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_8->Visible) { // revision_no_8 ?>
		<td<?php echo $document_log->revision_no_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_8" class="document_log_revision_no_8">
<span<?php echo $document_log->revision_no_8->viewAttributes() ?>>
<?php echo $document_log->revision_no_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_8->Visible) { // direction_8 ?>
		<td<?php echo $document_log->direction_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_8" class="document_log_direction_8">
<span<?php echo $document_log->direction_8->viewAttributes() ?>>
<?php echo $document_log->direction_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_8->Visible) { // planned_date_8 ?>
		<td<?php echo $document_log->planned_date_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_8" class="document_log_planned_date_8">
<span<?php echo $document_log->planned_date_8->viewAttributes() ?>>
<?php echo $document_log->planned_date_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_8->Visible) { // transmit_date_8 ?>
		<td<?php echo $document_log->transmit_date_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_8" class="document_log_transmit_date_8">
<span<?php echo $document_log->transmit_date_8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_8->Visible) { // transmit_no_8 ?>
		<td<?php echo $document_log->transmit_no_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_8" class="document_log_transmit_no_8">
<span<?php echo $document_log->transmit_no_8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_8->Visible) { // approval_status_8 ?>
		<td<?php echo $document_log->approval_status_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_8" class="document_log_approval_status_8">
<span<?php echo $document_log->approval_status_8->viewAttributes() ?>>
<?php echo $document_log->approval_status_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_9->Visible) { // submit_no_9 ?>
		<td<?php echo $document_log->submit_no_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_9" class="document_log_submit_no_9">
<span<?php echo $document_log->submit_no_9->viewAttributes() ?>>
<?php echo $document_log->submit_no_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_9->Visible) { // revision_no_9 ?>
		<td<?php echo $document_log->revision_no_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_9" class="document_log_revision_no_9">
<span<?php echo $document_log->revision_no_9->viewAttributes() ?>>
<?php echo $document_log->revision_no_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_9->Visible) { // direction_9 ?>
		<td<?php echo $document_log->direction_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_9" class="document_log_direction_9">
<span<?php echo $document_log->direction_9->viewAttributes() ?>>
<?php echo $document_log->direction_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_9->Visible) { // planned_date_9 ?>
		<td<?php echo $document_log->planned_date_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_9" class="document_log_planned_date_9">
<span<?php echo $document_log->planned_date_9->viewAttributes() ?>>
<?php echo $document_log->planned_date_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_9->Visible) { // transmit_date_9 ?>
		<td<?php echo $document_log->transmit_date_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_9" class="document_log_transmit_date_9">
<span<?php echo $document_log->transmit_date_9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_9->Visible) { // transmit_no_9 ?>
		<td<?php echo $document_log->transmit_no_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_9" class="document_log_transmit_no_9">
<span<?php echo $document_log->transmit_no_9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_9->Visible) { // approval_status_9 ?>
		<td<?php echo $document_log->approval_status_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_9" class="document_log_approval_status_9">
<span<?php echo $document_log->approval_status_9->viewAttributes() ?>>
<?php echo $document_log->approval_status_9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->submit_no_10->Visible) { // submit_no_10 ?>
		<td<?php echo $document_log->submit_no_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_submit_no_10" class="document_log_submit_no_10">
<span<?php echo $document_log->submit_no_10->viewAttributes() ?>>
<?php echo $document_log->submit_no_10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->revision_no_10->Visible) { // revision_no_10 ?>
		<td<?php echo $document_log->revision_no_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_revision_no_10" class="document_log_revision_no_10">
<span<?php echo $document_log->revision_no_10->viewAttributes() ?>>
<?php echo $document_log->revision_no_10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->direction_10->Visible) { // direction_10 ?>
		<td<?php echo $document_log->direction_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_direction_10" class="document_log_direction_10">
<span<?php echo $document_log->direction_10->viewAttributes() ?>>
<?php echo $document_log->direction_10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->planned_date_10->Visible) { // planned_date_10 ?>
		<td<?php echo $document_log->planned_date_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_planned_date_10" class="document_log_planned_date_10">
<span<?php echo $document_log->planned_date_10->viewAttributes() ?>>
<?php echo $document_log->planned_date_10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_date_10->Visible) { // transmit_date_10 ?>
		<td<?php echo $document_log->transmit_date_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_date_10" class="document_log_transmit_date_10">
<span<?php echo $document_log->transmit_date_10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->transmit_no_10->Visible) { // transmit_no_10 ?>
		<td<?php echo $document_log->transmit_no_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_transmit_no_10" class="document_log_transmit_no_10">
<span<?php echo $document_log->transmit_no_10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_10->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_log->approval_status_10->Visible) { // approval_status_10 ?>
		<td<?php echo $document_log->approval_status_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_delete->RowCnt ?>_document_log_approval_status_10" class="document_log_approval_status_10">
<span<?php echo $document_log->approval_status_10->viewAttributes() ?>>
<?php echo $document_log->approval_status_10->getViewValue() ?></span>
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