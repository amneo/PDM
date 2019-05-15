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
$document_log_view = new document_log_view();

// Run the page
$document_log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_log_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_log->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdocument_logview = currentForm = new ew.Form("fdocument_logview", "view");

// Form_CustomValidate event
fdocument_logview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_logview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_log->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $document_log_view->ExportOptions->render("body") ?>
<?php $document_log_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $document_log_view->showPageHeader(); ?>
<?php
$document_log_view->showMessage();
?>
<?php if (!$document_log_view->IsModal) { ?>
<?php if (!$document_log->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_log_view->Pager)) $document_log_view->Pager = new NumericPager($document_log_view->StartRec, $document_log_view->DisplayRecs, $document_log_view->TotalRecs, $document_log_view->RecRange, $document_log_view->AutoHidePager) ?>
<?php if ($document_log_view->Pager->RecordCount > 0 && $document_log_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_log_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_log_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_log_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_log_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_log_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_log_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdocument_logview" id="fdocument_logview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_log_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_log_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_log">
<input type="hidden" name="modal" value="<?php echo (int)$document_log_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($document_log->log_id->Visible) { // log_id ?>
	<tr id="r_log_id">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_log_id"><?php echo $document_log->log_id->caption() ?></span></td>
		<td data-name="log_id"<?php echo $document_log->log_id->cellAttributes() ?>>
<span id="el_document_log_log_id">
<span<?php echo $document_log->log_id->viewAttributes() ?>>
<?php echo $document_log->log_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_firelink_doc_no"><?php echo $document_log->firelink_doc_no->caption() ?></span></td>
		<td data-name="firelink_doc_no"<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_log_firelink_doc_no">
<span<?php echo $document_log->firelink_doc_no->viewAttributes() ?>>
<?php echo $document_log->firelink_doc_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_project_name"><?php echo $document_log->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el_document_log_project_name">
<span<?php echo $document_log->project_name->viewAttributes() ?>>
<?php echo $document_log->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_document_tittle"><?php echo $document_log->document_tittle->caption() ?></span></td>
		<td data-name="document_tittle"<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el_document_log_document_tittle">
<span<?php echo $document_log->document_tittle->viewAttributes() ?>>
<?php echo $document_log->document_tittle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
	<tr id="r_current_status">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_current_status"><?php echo $document_log->current_status->caption() ?></span></td>
		<td data-name="current_status"<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el_document_log_current_status">
<span<?php echo $document_log->current_status->viewAttributes() ?>>
<?php echo $document_log->current_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub1->Visible) { // submit_no_sub1 ?>
	<tr id="r_submit_no_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub1"><?php echo $document_log->submit_no_sub1->caption() ?></span></td>
		<td data-name="submit_no_sub1"<?php echo $document_log->submit_no_sub1->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub1">
<span<?php echo $document_log->submit_no_sub1->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub1->Visible) { // revision_no_sub1 ?>
	<tr id="r_revision_no_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub1"><?php echo $document_log->revision_no_sub1->caption() ?></span></td>
		<td data-name="revision_no_sub1"<?php echo $document_log->revision_no_sub1->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub1">
<span<?php echo $document_log->revision_no_sub1->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub1->Visible) { // direction_out_sub1 ?>
	<tr id="r_direction_out_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub1"><?php echo $document_log->direction_out_sub1->caption() ?></span></td>
		<td data-name="direction_out_sub1"<?php echo $document_log->direction_out_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub1">
<span<?php echo $document_log->direction_out_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub1->Visible) { // planned_date_out_sub1 ?>
	<tr id="r_planned_date_out_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub1"><?php echo $document_log->planned_date_out_sub1->caption() ?></span></td>
		<td data-name="planned_date_out_sub1"<?php echo $document_log->planned_date_out_sub1->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub1">
<span<?php echo $document_log->planned_date_out_sub1->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub1->Visible) { // transmit_date_out_sub1 ?>
	<tr id="r_transmit_date_out_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub1"><?php echo $document_log->transmit_date_out_sub1->caption() ?></span></td>
		<td data-name="transmit_date_out_sub1"<?php echo $document_log->transmit_date_out_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub1">
<span<?php echo $document_log->transmit_date_out_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub1->Visible) { // transmit_no_out_sub1 ?>
	<tr id="r_transmit_no_out_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub1"><?php echo $document_log->transmit_no_out_sub1->caption() ?></span></td>
		<td data-name="transmit_no_out_sub1"<?php echo $document_log->transmit_no_out_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub1">
<span<?php echo $document_log->transmit_no_out_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub1->Visible) { // approval_status_out_sub1 ?>
	<tr id="r_approval_status_out_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub1"><?php echo $document_log->approval_status_out_sub1->caption() ?></span></td>
		<td data-name="approval_status_out_sub1"<?php echo $document_log->approval_status_out_sub1->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub1">
<span<?php echo $document_log->approval_status_out_sub1->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_file_sub1->Visible) { // direction_out_file_sub1 ?>
	<tr id="r_direction_out_file_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_file_sub1"><?php echo $document_log->direction_out_file_sub1->caption() ?></span></td>
		<td data-name="direction_out_file_sub1"<?php echo $document_log->direction_out_file_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_out_file_sub1">
<span<?php echo $document_log->direction_out_file_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_out_file_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub1->Visible) { // direction_in_sub1 ?>
	<tr id="r_direction_in_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub1"><?php echo $document_log->direction_in_sub1->caption() ?></span></td>
		<td data-name="direction_in_sub1"<?php echo $document_log->direction_in_sub1->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub1">
<span<?php echo $document_log->direction_in_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub1->Visible) { // transmit_no_in_sub1 ?>
	<tr id="r_transmit_no_in_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub1"><?php echo $document_log->transmit_no_in_sub1->caption() ?></span></td>
		<td data-name="transmit_no_in_sub1"<?php echo $document_log->transmit_no_in_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub1">
<span<?php echo $document_log->transmit_no_in_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub1->Visible) { // approval_status_in_sub1 ?>
	<tr id="r_approval_status_in_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub1"><?php echo $document_log->approval_status_in_sub1->caption() ?></span></td>
		<td data-name="approval_status_in_sub1"<?php echo $document_log->approval_status_in_sub1->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub1">
<span<?php echo $document_log->approval_status_in_sub1->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub1->Visible) { // transmit_date_in_sub1 ?>
	<tr id="r_transmit_date_in_sub1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub1"><?php echo $document_log->transmit_date_in_sub1->caption() ?></span></td>
		<td data-name="transmit_date_in_sub1"<?php echo $document_log->transmit_date_in_sub1->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub1">
<span<?php echo $document_log->transmit_date_in_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub2->Visible) { // submit_no_sub2 ?>
	<tr id="r_submit_no_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub2"><?php echo $document_log->submit_no_sub2->caption() ?></span></td>
		<td data-name="submit_no_sub2"<?php echo $document_log->submit_no_sub2->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub2">
<span<?php echo $document_log->submit_no_sub2->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub2->Visible) { // revision_no_sub2 ?>
	<tr id="r_revision_no_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub2"><?php echo $document_log->revision_no_sub2->caption() ?></span></td>
		<td data-name="revision_no_sub2"<?php echo $document_log->revision_no_sub2->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub2">
<span<?php echo $document_log->revision_no_sub2->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub2->Visible) { // direction_out_sub2 ?>
	<tr id="r_direction_out_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub2"><?php echo $document_log->direction_out_sub2->caption() ?></span></td>
		<td data-name="direction_out_sub2"<?php echo $document_log->direction_out_sub2->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub2">
<span<?php echo $document_log->direction_out_sub2->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub2->Visible) { // planned_date_out_sub2 ?>
	<tr id="r_planned_date_out_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub2"><?php echo $document_log->planned_date_out_sub2->caption() ?></span></td>
		<td data-name="planned_date_out_sub2"<?php echo $document_log->planned_date_out_sub2->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub2">
<span<?php echo $document_log->planned_date_out_sub2->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub2->Visible) { // transmit_date_out_sub2 ?>
	<tr id="r_transmit_date_out_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub2"><?php echo $document_log->transmit_date_out_sub2->caption() ?></span></td>
		<td data-name="transmit_date_out_sub2"<?php echo $document_log->transmit_date_out_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub2">
<span<?php echo $document_log->transmit_date_out_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub2->Visible) { // transmit_no_out_sub2 ?>
	<tr id="r_transmit_no_out_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub2"><?php echo $document_log->transmit_no_out_sub2->caption() ?></span></td>
		<td data-name="transmit_no_out_sub2"<?php echo $document_log->transmit_no_out_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub2">
<span<?php echo $document_log->transmit_no_out_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub2->Visible) { // approval_status_out_sub2 ?>
	<tr id="r_approval_status_out_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub2"><?php echo $document_log->approval_status_out_sub2->caption() ?></span></td>
		<td data-name="approval_status_out_sub2"<?php echo $document_log->approval_status_out_sub2->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub2">
<span<?php echo $document_log->approval_status_out_sub2->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub2->Visible) { // direction_in_sub2 ?>
	<tr id="r_direction_in_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub2"><?php echo $document_log->direction_in_sub2->caption() ?></span></td>
		<td data-name="direction_in_sub2"<?php echo $document_log->direction_in_sub2->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub2">
<span<?php echo $document_log->direction_in_sub2->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub2->Visible) { // transmit_no_in_sub2 ?>
	<tr id="r_transmit_no_in_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub2"><?php echo $document_log->transmit_no_in_sub2->caption() ?></span></td>
		<td data-name="transmit_no_in_sub2"<?php echo $document_log->transmit_no_in_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub2">
<span<?php echo $document_log->transmit_no_in_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub2->Visible) { // approval_status_in_sub2 ?>
	<tr id="r_approval_status_in_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub2"><?php echo $document_log->approval_status_in_sub2->caption() ?></span></td>
		<td data-name="approval_status_in_sub2"<?php echo $document_log->approval_status_in_sub2->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub2">
<span<?php echo $document_log->approval_status_in_sub2->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub2->Visible) { // transmit_date_in_sub2 ?>
	<tr id="r_transmit_date_in_sub2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub2"><?php echo $document_log->transmit_date_in_sub2->caption() ?></span></td>
		<td data-name="transmit_date_in_sub2"<?php echo $document_log->transmit_date_in_sub2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub2">
<span<?php echo $document_log->transmit_date_in_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub3->Visible) { // submit_no_sub3 ?>
	<tr id="r_submit_no_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub3"><?php echo $document_log->submit_no_sub3->caption() ?></span></td>
		<td data-name="submit_no_sub3"<?php echo $document_log->submit_no_sub3->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub3">
<span<?php echo $document_log->submit_no_sub3->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub3->Visible) { // revision_no_sub3 ?>
	<tr id="r_revision_no_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub3"><?php echo $document_log->revision_no_sub3->caption() ?></span></td>
		<td data-name="revision_no_sub3"<?php echo $document_log->revision_no_sub3->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub3">
<span<?php echo $document_log->revision_no_sub3->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub3->Visible) { // direction_out_sub3 ?>
	<tr id="r_direction_out_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub3"><?php echo $document_log->direction_out_sub3->caption() ?></span></td>
		<td data-name="direction_out_sub3"<?php echo $document_log->direction_out_sub3->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub3">
<span<?php echo $document_log->direction_out_sub3->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub3->Visible) { // planned_date_out_sub3 ?>
	<tr id="r_planned_date_out_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub3"><?php echo $document_log->planned_date_out_sub3->caption() ?></span></td>
		<td data-name="planned_date_out_sub3"<?php echo $document_log->planned_date_out_sub3->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub3">
<span<?php echo $document_log->planned_date_out_sub3->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub3->Visible) { // transmit_date_out_sub3 ?>
	<tr id="r_transmit_date_out_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub3"><?php echo $document_log->transmit_date_out_sub3->caption() ?></span></td>
		<td data-name="transmit_date_out_sub3"<?php echo $document_log->transmit_date_out_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub3">
<span<?php echo $document_log->transmit_date_out_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub3->Visible) { // transmit_no_out_sub3 ?>
	<tr id="r_transmit_no_out_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub3"><?php echo $document_log->transmit_no_out_sub3->caption() ?></span></td>
		<td data-name="transmit_no_out_sub3"<?php echo $document_log->transmit_no_out_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub3">
<span<?php echo $document_log->transmit_no_out_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub3->Visible) { // approval_status_out_sub3 ?>
	<tr id="r_approval_status_out_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub3"><?php echo $document_log->approval_status_out_sub3->caption() ?></span></td>
		<td data-name="approval_status_out_sub3"<?php echo $document_log->approval_status_out_sub3->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub3">
<span<?php echo $document_log->approval_status_out_sub3->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub3->Visible) { // direction_in_sub3 ?>
	<tr id="r_direction_in_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub3"><?php echo $document_log->direction_in_sub3->caption() ?></span></td>
		<td data-name="direction_in_sub3"<?php echo $document_log->direction_in_sub3->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub3">
<span<?php echo $document_log->direction_in_sub3->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub3->Visible) { // transmit_no_in_sub3 ?>
	<tr id="r_transmit_no_in_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub3"><?php echo $document_log->transmit_no_in_sub3->caption() ?></span></td>
		<td data-name="transmit_no_in_sub3"<?php echo $document_log->transmit_no_in_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub3">
<span<?php echo $document_log->transmit_no_in_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub3->Visible) { // approval_status_in_sub3 ?>
	<tr id="r_approval_status_in_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub3"><?php echo $document_log->approval_status_in_sub3->caption() ?></span></td>
		<td data-name="approval_status_in_sub3"<?php echo $document_log->approval_status_in_sub3->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub3">
<span<?php echo $document_log->approval_status_in_sub3->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub3->Visible) { // transmit_date_in_sub3 ?>
	<tr id="r_transmit_date_in_sub3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub3"><?php echo $document_log->transmit_date_in_sub3->caption() ?></span></td>
		<td data-name="transmit_date_in_sub3"<?php echo $document_log->transmit_date_in_sub3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub3">
<span<?php echo $document_log->transmit_date_in_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub4->Visible) { // submit_no_sub4 ?>
	<tr id="r_submit_no_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub4"><?php echo $document_log->submit_no_sub4->caption() ?></span></td>
		<td data-name="submit_no_sub4"<?php echo $document_log->submit_no_sub4->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub4">
<span<?php echo $document_log->submit_no_sub4->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub4->Visible) { // revision_no_sub4 ?>
	<tr id="r_revision_no_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub4"><?php echo $document_log->revision_no_sub4->caption() ?></span></td>
		<td data-name="revision_no_sub4"<?php echo $document_log->revision_no_sub4->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub4">
<span<?php echo $document_log->revision_no_sub4->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub4->Visible) { // direction_out_sub4 ?>
	<tr id="r_direction_out_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub4"><?php echo $document_log->direction_out_sub4->caption() ?></span></td>
		<td data-name="direction_out_sub4"<?php echo $document_log->direction_out_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub4">
<span<?php echo $document_log->direction_out_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub4->Visible) { // planned_date_out_sub4 ?>
	<tr id="r_planned_date_out_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub4"><?php echo $document_log->planned_date_out_sub4->caption() ?></span></td>
		<td data-name="planned_date_out_sub4"<?php echo $document_log->planned_date_out_sub4->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub4">
<span<?php echo $document_log->planned_date_out_sub4->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub4->Visible) { // transmit_date_out_sub4 ?>
	<tr id="r_transmit_date_out_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub4"><?php echo $document_log->transmit_date_out_sub4->caption() ?></span></td>
		<td data-name="transmit_date_out_sub4"<?php echo $document_log->transmit_date_out_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub4">
<span<?php echo $document_log->transmit_date_out_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub4->Visible) { // transmit_no_out_sub4 ?>
	<tr id="r_transmit_no_out_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub4"><?php echo $document_log->transmit_no_out_sub4->caption() ?></span></td>
		<td data-name="transmit_no_out_sub4"<?php echo $document_log->transmit_no_out_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub4">
<span<?php echo $document_log->transmit_no_out_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub4->Visible) { // approval_status_out_sub4 ?>
	<tr id="r_approval_status_out_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub4"><?php echo $document_log->approval_status_out_sub4->caption() ?></span></td>
		<td data-name="approval_status_out_sub4"<?php echo $document_log->approval_status_out_sub4->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub4">
<span<?php echo $document_log->approval_status_out_sub4->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub4->Visible) { // direction_in_sub4 ?>
	<tr id="r_direction_in_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub4"><?php echo $document_log->direction_in_sub4->caption() ?></span></td>
		<td data-name="direction_in_sub4"<?php echo $document_log->direction_in_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub4">
<span<?php echo $document_log->direction_in_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub4->Visible) { // transmit_no_in_sub4 ?>
	<tr id="r_transmit_no_in_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub4"><?php echo $document_log->transmit_no_in_sub4->caption() ?></span></td>
		<td data-name="transmit_no_in_sub4"<?php echo $document_log->transmit_no_in_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub4">
<span<?php echo $document_log->transmit_no_in_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub4->Visible) { // approval_status_in_sub4 ?>
	<tr id="r_approval_status_in_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub4"><?php echo $document_log->approval_status_in_sub4->caption() ?></span></td>
		<td data-name="approval_status_in_sub4"<?php echo $document_log->approval_status_in_sub4->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub4">
<span<?php echo $document_log->approval_status_in_sub4->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_file_sub4->Visible) { // direction_in_file_sub4 ?>
	<tr id="r_direction_in_file_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_file_sub4"><?php echo $document_log->direction_in_file_sub4->caption() ?></span></td>
		<td data-name="direction_in_file_sub4"<?php echo $document_log->direction_in_file_sub4->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub4">
<span<?php echo $document_log->direction_in_file_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub4->Visible) { // transmit_date_in_sub4 ?>
	<tr id="r_transmit_date_in_sub4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub4"><?php echo $document_log->transmit_date_in_sub4->caption() ?></span></td>
		<td data-name="transmit_date_in_sub4"<?php echo $document_log->transmit_date_in_sub4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub4">
<span<?php echo $document_log->transmit_date_in_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub5->Visible) { // submit_no_sub5 ?>
	<tr id="r_submit_no_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub5"><?php echo $document_log->submit_no_sub5->caption() ?></span></td>
		<td data-name="submit_no_sub5"<?php echo $document_log->submit_no_sub5->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub5">
<span<?php echo $document_log->submit_no_sub5->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub5->Visible) { // revision_no_sub5 ?>
	<tr id="r_revision_no_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub5"><?php echo $document_log->revision_no_sub5->caption() ?></span></td>
		<td data-name="revision_no_sub5"<?php echo $document_log->revision_no_sub5->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub5">
<span<?php echo $document_log->revision_no_sub5->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub5->Visible) { // direction_out_sub5 ?>
	<tr id="r_direction_out_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub5"><?php echo $document_log->direction_out_sub5->caption() ?></span></td>
		<td data-name="direction_out_sub5"<?php echo $document_log->direction_out_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub5">
<span<?php echo $document_log->direction_out_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub5->Visible) { // planned_date_out_sub5 ?>
	<tr id="r_planned_date_out_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub5"><?php echo $document_log->planned_date_out_sub5->caption() ?></span></td>
		<td data-name="planned_date_out_sub5"<?php echo $document_log->planned_date_out_sub5->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub5">
<span<?php echo $document_log->planned_date_out_sub5->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub5->Visible) { // transmit_date_out_sub5 ?>
	<tr id="r_transmit_date_out_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub5"><?php echo $document_log->transmit_date_out_sub5->caption() ?></span></td>
		<td data-name="transmit_date_out_sub5"<?php echo $document_log->transmit_date_out_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub5">
<span<?php echo $document_log->transmit_date_out_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub5->Visible) { // transmit_no_out_sub5 ?>
	<tr id="r_transmit_no_out_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub5"><?php echo $document_log->transmit_no_out_sub5->caption() ?></span></td>
		<td data-name="transmit_no_out_sub5"<?php echo $document_log->transmit_no_out_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub5">
<span<?php echo $document_log->transmit_no_out_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub5->Visible) { // approval_status_out_sub5 ?>
	<tr id="r_approval_status_out_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub5"><?php echo $document_log->approval_status_out_sub5->caption() ?></span></td>
		<td data-name="approval_status_out_sub5"<?php echo $document_log->approval_status_out_sub5->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub5">
<span<?php echo $document_log->approval_status_out_sub5->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub5->Visible) { // direction_in_sub5 ?>
	<tr id="r_direction_in_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub5"><?php echo $document_log->direction_in_sub5->caption() ?></span></td>
		<td data-name="direction_in_sub5"<?php echo $document_log->direction_in_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub5">
<span<?php echo $document_log->direction_in_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub5->Visible) { // transmit_no_in_sub5 ?>
	<tr id="r_transmit_no_in_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub5"><?php echo $document_log->transmit_no_in_sub5->caption() ?></span></td>
		<td data-name="transmit_no_in_sub5"<?php echo $document_log->transmit_no_in_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub5">
<span<?php echo $document_log->transmit_no_in_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub5->Visible) { // approval_status_in_sub5 ?>
	<tr id="r_approval_status_in_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub5"><?php echo $document_log->approval_status_in_sub5->caption() ?></span></td>
		<td data-name="approval_status_in_sub5"<?php echo $document_log->approval_status_in_sub5->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub5">
<span<?php echo $document_log->approval_status_in_sub5->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_file_sub5->Visible) { // direction_in_file_sub5 ?>
	<tr id="r_direction_in_file_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_file_sub5"><?php echo $document_log->direction_in_file_sub5->caption() ?></span></td>
		<td data-name="direction_in_file_sub5"<?php echo $document_log->direction_in_file_sub5->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub5">
<span<?php echo $document_log->direction_in_file_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub5->Visible) { // transmit_date_in_sub5 ?>
	<tr id="r_transmit_date_in_sub5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub5"><?php echo $document_log->transmit_date_in_sub5->caption() ?></span></td>
		<td data-name="transmit_date_in_sub5"<?php echo $document_log->transmit_date_in_sub5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub5">
<span<?php echo $document_log->transmit_date_in_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub6->Visible) { // submit_no_sub6 ?>
	<tr id="r_submit_no_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub6"><?php echo $document_log->submit_no_sub6->caption() ?></span></td>
		<td data-name="submit_no_sub6"<?php echo $document_log->submit_no_sub6->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub6">
<span<?php echo $document_log->submit_no_sub6->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub6->Visible) { // revision_no_sub6 ?>
	<tr id="r_revision_no_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub6"><?php echo $document_log->revision_no_sub6->caption() ?></span></td>
		<td data-name="revision_no_sub6"<?php echo $document_log->revision_no_sub6->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub6">
<span<?php echo $document_log->revision_no_sub6->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub6->Visible) { // direction_out_sub6 ?>
	<tr id="r_direction_out_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub6"><?php echo $document_log->direction_out_sub6->caption() ?></span></td>
		<td data-name="direction_out_sub6"<?php echo $document_log->direction_out_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub6">
<span<?php echo $document_log->direction_out_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub6->Visible) { // planned_date_out_sub6 ?>
	<tr id="r_planned_date_out_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub6"><?php echo $document_log->planned_date_out_sub6->caption() ?></span></td>
		<td data-name="planned_date_out_sub6"<?php echo $document_log->planned_date_out_sub6->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub6">
<span<?php echo $document_log->planned_date_out_sub6->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub6->Visible) { // transmit_date_out_sub6 ?>
	<tr id="r_transmit_date_out_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub6"><?php echo $document_log->transmit_date_out_sub6->caption() ?></span></td>
		<td data-name="transmit_date_out_sub6"<?php echo $document_log->transmit_date_out_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub6">
<span<?php echo $document_log->transmit_date_out_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub6->Visible) { // transmit_no_out_sub6 ?>
	<tr id="r_transmit_no_out_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub6"><?php echo $document_log->transmit_no_out_sub6->caption() ?></span></td>
		<td data-name="transmit_no_out_sub6"<?php echo $document_log->transmit_no_out_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub6">
<span<?php echo $document_log->transmit_no_out_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub6->Visible) { // approval_status_out_sub6 ?>
	<tr id="r_approval_status_out_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub6"><?php echo $document_log->approval_status_out_sub6->caption() ?></span></td>
		<td data-name="approval_status_out_sub6"<?php echo $document_log->approval_status_out_sub6->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub6">
<span<?php echo $document_log->approval_status_out_sub6->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub6->Visible) { // direction_in_sub6 ?>
	<tr id="r_direction_in_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub6"><?php echo $document_log->direction_in_sub6->caption() ?></span></td>
		<td data-name="direction_in_sub6"<?php echo $document_log->direction_in_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub6">
<span<?php echo $document_log->direction_in_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub6->Visible) { // transmit_no_in_sub6 ?>
	<tr id="r_transmit_no_in_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub6"><?php echo $document_log->transmit_no_in_sub6->caption() ?></span></td>
		<td data-name="transmit_no_in_sub6"<?php echo $document_log->transmit_no_in_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub6">
<span<?php echo $document_log->transmit_no_in_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub6->Visible) { // approval_status_in_sub6 ?>
	<tr id="r_approval_status_in_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub6"><?php echo $document_log->approval_status_in_sub6->caption() ?></span></td>
		<td data-name="approval_status_in_sub6"<?php echo $document_log->approval_status_in_sub6->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub6">
<span<?php echo $document_log->approval_status_in_sub6->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_file_sub6->Visible) { // direction_in_file_sub6 ?>
	<tr id="r_direction_in_file_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_file_sub6"><?php echo $document_log->direction_in_file_sub6->caption() ?></span></td>
		<td data-name="direction_in_file_sub6"<?php echo $document_log->direction_in_file_sub6->cellAttributes() ?>>
<span id="el_document_log_direction_in_file_sub6">
<span<?php echo $document_log->direction_in_file_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub6->Visible) { // transmit_date_in_sub6 ?>
	<tr id="r_transmit_date_in_sub6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub6"><?php echo $document_log->transmit_date_in_sub6->caption() ?></span></td>
		<td data-name="transmit_date_in_sub6"<?php echo $document_log->transmit_date_in_sub6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub6">
<span<?php echo $document_log->transmit_date_in_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub7->Visible) { // submit_no_sub7 ?>
	<tr id="r_submit_no_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub7"><?php echo $document_log->submit_no_sub7->caption() ?></span></td>
		<td data-name="submit_no_sub7"<?php echo $document_log->submit_no_sub7->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub7">
<span<?php echo $document_log->submit_no_sub7->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub7->Visible) { // revision_no_sub7 ?>
	<tr id="r_revision_no_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub7"><?php echo $document_log->revision_no_sub7->caption() ?></span></td>
		<td data-name="revision_no_sub7"<?php echo $document_log->revision_no_sub7->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub7">
<span<?php echo $document_log->revision_no_sub7->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub7->Visible) { // direction_out_sub7 ?>
	<tr id="r_direction_out_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub7"><?php echo $document_log->direction_out_sub7->caption() ?></span></td>
		<td data-name="direction_out_sub7"<?php echo $document_log->direction_out_sub7->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub7">
<span<?php echo $document_log->direction_out_sub7->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub7->Visible) { // planned_date_out_sub7 ?>
	<tr id="r_planned_date_out_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub7"><?php echo $document_log->planned_date_out_sub7->caption() ?></span></td>
		<td data-name="planned_date_out_sub7"<?php echo $document_log->planned_date_out_sub7->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub7">
<span<?php echo $document_log->planned_date_out_sub7->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub7->Visible) { // transmit_date_out_sub7 ?>
	<tr id="r_transmit_date_out_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub7"><?php echo $document_log->transmit_date_out_sub7->caption() ?></span></td>
		<td data-name="transmit_date_out_sub7"<?php echo $document_log->transmit_date_out_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub7">
<span<?php echo $document_log->transmit_date_out_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub7->Visible) { // transmit_no_out_sub7 ?>
	<tr id="r_transmit_no_out_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub7"><?php echo $document_log->transmit_no_out_sub7->caption() ?></span></td>
		<td data-name="transmit_no_out_sub7"<?php echo $document_log->transmit_no_out_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub7">
<span<?php echo $document_log->transmit_no_out_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub7->Visible) { // approval_status_out_sub7 ?>
	<tr id="r_approval_status_out_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub7"><?php echo $document_log->approval_status_out_sub7->caption() ?></span></td>
		<td data-name="approval_status_out_sub7"<?php echo $document_log->approval_status_out_sub7->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub7">
<span<?php echo $document_log->approval_status_out_sub7->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub7->Visible) { // direction_in_sub7 ?>
	<tr id="r_direction_in_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub7"><?php echo $document_log->direction_in_sub7->caption() ?></span></td>
		<td data-name="direction_in_sub7"<?php echo $document_log->direction_in_sub7->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub7">
<span<?php echo $document_log->direction_in_sub7->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub7->Visible) { // transmit_no_in_sub7 ?>
	<tr id="r_transmit_no_in_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub7"><?php echo $document_log->transmit_no_in_sub7->caption() ?></span></td>
		<td data-name="transmit_no_in_sub7"<?php echo $document_log->transmit_no_in_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub7">
<span<?php echo $document_log->transmit_no_in_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub7->Visible) { // approval_status_in_sub7 ?>
	<tr id="r_approval_status_in_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub7"><?php echo $document_log->approval_status_in_sub7->caption() ?></span></td>
		<td data-name="approval_status_in_sub7"<?php echo $document_log->approval_status_in_sub7->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub7">
<span<?php echo $document_log->approval_status_in_sub7->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub7->Visible) { // transmit_date_in_sub7 ?>
	<tr id="r_transmit_date_in_sub7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub7"><?php echo $document_log->transmit_date_in_sub7->caption() ?></span></td>
		<td data-name="transmit_date_in_sub7"<?php echo $document_log->transmit_date_in_sub7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub7">
<span<?php echo $document_log->transmit_date_in_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub8->Visible) { // submit_no_sub8 ?>
	<tr id="r_submit_no_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub8"><?php echo $document_log->submit_no_sub8->caption() ?></span></td>
		<td data-name="submit_no_sub8"<?php echo $document_log->submit_no_sub8->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub8">
<span<?php echo $document_log->submit_no_sub8->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub8->Visible) { // revision_no_sub8 ?>
	<tr id="r_revision_no_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub8"><?php echo $document_log->revision_no_sub8->caption() ?></span></td>
		<td data-name="revision_no_sub8"<?php echo $document_log->revision_no_sub8->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub8">
<span<?php echo $document_log->revision_no_sub8->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub8->Visible) { // direction_out_sub8 ?>
	<tr id="r_direction_out_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub8"><?php echo $document_log->direction_out_sub8->caption() ?></span></td>
		<td data-name="direction_out_sub8"<?php echo $document_log->direction_out_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub8">
<span<?php echo $document_log->direction_out_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub8->Visible) { // planned_date_out_sub8 ?>
	<tr id="r_planned_date_out_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub8"><?php echo $document_log->planned_date_out_sub8->caption() ?></span></td>
		<td data-name="planned_date_out_sub8"<?php echo $document_log->planned_date_out_sub8->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub8">
<span<?php echo $document_log->planned_date_out_sub8->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub8->Visible) { // transmit_date_out_sub8 ?>
	<tr id="r_transmit_date_out_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub8"><?php echo $document_log->transmit_date_out_sub8->caption() ?></span></td>
		<td data-name="transmit_date_out_sub8"<?php echo $document_log->transmit_date_out_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub8">
<span<?php echo $document_log->transmit_date_out_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub8->Visible) { // transmit_no_out_sub8 ?>
	<tr id="r_transmit_no_out_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub8"><?php echo $document_log->transmit_no_out_sub8->caption() ?></span></td>
		<td data-name="transmit_no_out_sub8"<?php echo $document_log->transmit_no_out_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub8">
<span<?php echo $document_log->transmit_no_out_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub8->Visible) { // approval_status_out_sub8 ?>
	<tr id="r_approval_status_out_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub8"><?php echo $document_log->approval_status_out_sub8->caption() ?></span></td>
		<td data-name="approval_status_out_sub8"<?php echo $document_log->approval_status_out_sub8->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub8">
<span<?php echo $document_log->approval_status_out_sub8->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_file_sub8->Visible) { // direction_out_file_sub8 ?>
	<tr id="r_direction_out_file_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_file_sub8"><?php echo $document_log->direction_out_file_sub8->caption() ?></span></td>
		<td data-name="direction_out_file_sub8"<?php echo $document_log->direction_out_file_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_out_file_sub8">
<span<?php echo $document_log->direction_out_file_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_out_file_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub8->Visible) { // direction_in_sub8 ?>
	<tr id="r_direction_in_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub8"><?php echo $document_log->direction_in_sub8->caption() ?></span></td>
		<td data-name="direction_in_sub8"<?php echo $document_log->direction_in_sub8->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub8">
<span<?php echo $document_log->direction_in_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub8->Visible) { // transmit_no_in_sub8 ?>
	<tr id="r_transmit_no_in_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub8"><?php echo $document_log->transmit_no_in_sub8->caption() ?></span></td>
		<td data-name="transmit_no_in_sub8"<?php echo $document_log->transmit_no_in_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub8">
<span<?php echo $document_log->transmit_no_in_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub8->Visible) { // approval_status_in_sub8 ?>
	<tr id="r_approval_status_in_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub8"><?php echo $document_log->approval_status_in_sub8->caption() ?></span></td>
		<td data-name="approval_status_in_sub8"<?php echo $document_log->approval_status_in_sub8->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub8">
<span<?php echo $document_log->approval_status_in_sub8->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub8->Visible) { // transmit_date_in_sub8 ?>
	<tr id="r_transmit_date_in_sub8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub8"><?php echo $document_log->transmit_date_in_sub8->caption() ?></span></td>
		<td data-name="transmit_date_in_sub8"<?php echo $document_log->transmit_date_in_sub8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub8">
<span<?php echo $document_log->transmit_date_in_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub9->Visible) { // submit_no_sub9 ?>
	<tr id="r_submit_no_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub9"><?php echo $document_log->submit_no_sub9->caption() ?></span></td>
		<td data-name="submit_no_sub9"<?php echo $document_log->submit_no_sub9->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub9">
<span<?php echo $document_log->submit_no_sub9->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub9->Visible) { // revision_no_sub9 ?>
	<tr id="r_revision_no_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub9"><?php echo $document_log->revision_no_sub9->caption() ?></span></td>
		<td data-name="revision_no_sub9"<?php echo $document_log->revision_no_sub9->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub9">
<span<?php echo $document_log->revision_no_sub9->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub9->Visible) { // direction_out_sub9 ?>
	<tr id="r_direction_out_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub9"><?php echo $document_log->direction_out_sub9->caption() ?></span></td>
		<td data-name="direction_out_sub9"<?php echo $document_log->direction_out_sub9->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub9">
<span<?php echo $document_log->direction_out_sub9->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub9->Visible) { // planned_date_out_sub9 ?>
	<tr id="r_planned_date_out_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub9"><?php echo $document_log->planned_date_out_sub9->caption() ?></span></td>
		<td data-name="planned_date_out_sub9"<?php echo $document_log->planned_date_out_sub9->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub9">
<span<?php echo $document_log->planned_date_out_sub9->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub9->Visible) { // transmit_date_out_sub9 ?>
	<tr id="r_transmit_date_out_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub9"><?php echo $document_log->transmit_date_out_sub9->caption() ?></span></td>
		<td data-name="transmit_date_out_sub9"<?php echo $document_log->transmit_date_out_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub9">
<span<?php echo $document_log->transmit_date_out_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub9->Visible) { // transmit_no_out_sub9 ?>
	<tr id="r_transmit_no_out_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub9"><?php echo $document_log->transmit_no_out_sub9->caption() ?></span></td>
		<td data-name="transmit_no_out_sub9"<?php echo $document_log->transmit_no_out_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub9">
<span<?php echo $document_log->transmit_no_out_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub9->Visible) { // approval_status_out_sub9 ?>
	<tr id="r_approval_status_out_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub9"><?php echo $document_log->approval_status_out_sub9->caption() ?></span></td>
		<td data-name="approval_status_out_sub9"<?php echo $document_log->approval_status_out_sub9->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub9">
<span<?php echo $document_log->approval_status_out_sub9->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub9->Visible) { // direction_in_sub9 ?>
	<tr id="r_direction_in_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub9"><?php echo $document_log->direction_in_sub9->caption() ?></span></td>
		<td data-name="direction_in_sub9"<?php echo $document_log->direction_in_sub9->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub9">
<span<?php echo $document_log->direction_in_sub9->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub9->Visible) { // transmit_no_in_sub9 ?>
	<tr id="r_transmit_no_in_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub9"><?php echo $document_log->transmit_no_in_sub9->caption() ?></span></td>
		<td data-name="transmit_no_in_sub9"<?php echo $document_log->transmit_no_in_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub9">
<span<?php echo $document_log->transmit_no_in_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub9->Visible) { // approval_status_in_sub9 ?>
	<tr id="r_approval_status_in_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub9"><?php echo $document_log->approval_status_in_sub9->caption() ?></span></td>
		<td data-name="approval_status_in_sub9"<?php echo $document_log->approval_status_in_sub9->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub9">
<span<?php echo $document_log->approval_status_in_sub9->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub9->Visible) { // transmit_date_in_sub9 ?>
	<tr id="r_transmit_date_in_sub9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub9"><?php echo $document_log->transmit_date_in_sub9->caption() ?></span></td>
		<td data-name="transmit_date_in_sub9"<?php echo $document_log->transmit_date_in_sub9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub9">
<span<?php echo $document_log->transmit_date_in_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_sub10->Visible) { // submit_no_sub10 ?>
	<tr id="r_submit_no_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_sub10"><?php echo $document_log->submit_no_sub10->caption() ?></span></td>
		<td data-name="submit_no_sub10"<?php echo $document_log->submit_no_sub10->cellAttributes() ?>>
<span id="el_document_log_submit_no_sub10">
<span<?php echo $document_log->submit_no_sub10->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_sub10->Visible) { // revision_no_sub10 ?>
	<tr id="r_revision_no_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_sub10"><?php echo $document_log->revision_no_sub10->caption() ?></span></td>
		<td data-name="revision_no_sub10"<?php echo $document_log->revision_no_sub10->cellAttributes() ?>>
<span id="el_document_log_revision_no_sub10">
<span<?php echo $document_log->revision_no_sub10->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_out_sub10->Visible) { // direction_out_sub10 ?>
	<tr id="r_direction_out_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_out_sub10"><?php echo $document_log->direction_out_sub10->caption() ?></span></td>
		<td data-name="direction_out_sub10"<?php echo $document_log->direction_out_sub10->cellAttributes() ?>>
<span id="el_document_log_direction_out_sub10">
<span<?php echo $document_log->direction_out_sub10->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_out_sub10->Visible) { // planned_date_out_sub10 ?>
	<tr id="r_planned_date_out_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_out_sub10"><?php echo $document_log->planned_date_out_sub10->caption() ?></span></td>
		<td data-name="planned_date_out_sub10"<?php echo $document_log->planned_date_out_sub10->cellAttributes() ?>>
<span id="el_document_log_planned_date_out_sub10">
<span<?php echo $document_log->planned_date_out_sub10->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub10->Visible) { // transmit_date_out_sub10 ?>
	<tr id="r_transmit_date_out_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_out_sub10"><?php echo $document_log->transmit_date_out_sub10->caption() ?></span></td>
		<td data-name="transmit_date_out_sub10"<?php echo $document_log->transmit_date_out_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_out_sub10">
<span<?php echo $document_log->transmit_date_out_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub10->Visible) { // transmit_no_out_sub10 ?>
	<tr id="r_transmit_no_out_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_out_sub10"><?php echo $document_log->transmit_no_out_sub10->caption() ?></span></td>
		<td data-name="transmit_no_out_sub10"<?php echo $document_log->transmit_no_out_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_out_sub10">
<span<?php echo $document_log->transmit_no_out_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_out_sub10->Visible) { // approval_status_out_sub10 ?>
	<tr id="r_approval_status_out_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_out_sub10"><?php echo $document_log->approval_status_out_sub10->caption() ?></span></td>
		<td data-name="approval_status_out_sub10"<?php echo $document_log->approval_status_out_sub10->cellAttributes() ?>>
<span id="el_document_log_approval_status_out_sub10">
<span<?php echo $document_log->approval_status_out_sub10->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_in_sub10->Visible) { // direction_in_sub10 ?>
	<tr id="r_direction_in_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_in_sub10"><?php echo $document_log->direction_in_sub10->caption() ?></span></td>
		<td data-name="direction_in_sub10"<?php echo $document_log->direction_in_sub10->cellAttributes() ?>>
<span id="el_document_log_direction_in_sub10">
<span<?php echo $document_log->direction_in_sub10->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub10->Visible) { // transmit_no_in_sub10 ?>
	<tr id="r_transmit_no_in_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_in_sub10"><?php echo $document_log->transmit_no_in_sub10->caption() ?></span></td>
		<td data-name="transmit_no_in_sub10"<?php echo $document_log->transmit_no_in_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_in_sub10">
<span<?php echo $document_log->transmit_no_in_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_in_sub10->Visible) { // approval_status_in_sub10 ?>
	<tr id="r_approval_status_in_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_in_sub10"><?php echo $document_log->approval_status_in_sub10->caption() ?></span></td>
		<td data-name="approval_status_in_sub10"<?php echo $document_log->approval_status_in_sub10->cellAttributes() ?>>
<span id="el_document_log_approval_status_in_sub10">
<span<?php echo $document_log->approval_status_in_sub10->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub10->Visible) { // transmit_date_in_sub10 ?>
	<tr id="r_transmit_date_in_sub10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_in_sub10"><?php echo $document_log->transmit_date_in_sub10->caption() ?></span></td>
		<td data-name="transmit_date_in_sub10"<?php echo $document_log->transmit_date_in_sub10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_in_sub10">
<span<?php echo $document_log->transmit_date_in_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
	<tr id="r_log_updatedon">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_log_updatedon"><?php echo $document_log->log_updatedon->caption() ?></span></td>
		<td data-name="log_updatedon"<?php echo $document_log->log_updatedon->cellAttributes() ?>>
<span id="el_document_log_log_updatedon">
<span<?php echo $document_log->log_updatedon->viewAttributes() ?>>
<?php echo $document_log->log_updatedon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$document_log_view->IsModal) { ?>
<?php if (!$document_log->isExport()) { ?>
<?php if (!isset($document_log_view->Pager)) $document_log_view->Pager = new NumericPager($document_log_view->StartRec, $document_log_view->DisplayRecs, $document_log_view->TotalRecs, $document_log_view->RecRange, $document_log_view->AutoHidePager) ?>
<?php if ($document_log_view->Pager->RecordCount > 0 && $document_log_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_log_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_log_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_log_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_log_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_log_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_log_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_view->pageUrl() ?>start=<?php echo $document_log_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$document_log_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_log->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_log_view->terminate();
?>