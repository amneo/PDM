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
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_client_doc_no"><?php echo $document_log->client_doc_no->caption() ?></span></td>
		<td data-name="client_doc_no"<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el_document_log_client_doc_no">
<span<?php echo $document_log->client_doc_no->viewAttributes() ?>>
<?php echo $document_log->client_doc_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
	<tr id="r_order_number">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_order_number"><?php echo $document_log->order_number->caption() ?></span></td>
		<td data-name="order_number"<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el_document_log_order_number">
<span<?php echo $document_log->order_number->viewAttributes() ?>>
<?php echo $document_log->order_number->getViewValue() ?></span>
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
<?php if ((!EmptyString($document_log->current_status->getViewValue())) && $document_log->current_status->linkAttributes() <> "") { ?>
<a<?php echo $document_log->current_status->linkAttributes() ?>><?php echo $document_log->current_status->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->current_status->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_1->Visible) { // submit_no_1 ?>
	<tr id="r_submit_no_1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_1"><?php echo $document_log->submit_no_1->caption() ?></span></td>
		<td data-name="submit_no_1"<?php echo $document_log->submit_no_1->cellAttributes() ?>>
<span id="el_document_log_submit_no_1">
<span<?php echo $document_log->submit_no_1->viewAttributes() ?>>
<?php echo $document_log->submit_no_1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_1->Visible) { // revision_no_1 ?>
	<tr id="r_revision_no_1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_1"><?php echo $document_log->revision_no_1->caption() ?></span></td>
		<td data-name="revision_no_1"<?php echo $document_log->revision_no_1->cellAttributes() ?>>
<span id="el_document_log_revision_no_1">
<span<?php echo $document_log->revision_no_1->viewAttributes() ?>>
<?php echo $document_log->revision_no_1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_1->Visible) { // direction_1 ?>
	<tr id="r_direction_1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_1"><?php echo $document_log->direction_1->caption() ?></span></td>
		<td data-name="direction_1"<?php echo $document_log->direction_1->cellAttributes() ?>>
<span id="el_document_log_direction_1">
<span<?php echo $document_log->direction_1->viewAttributes() ?>>
<?php echo $document_log->direction_1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_1->Visible) { // transmit_no_1 ?>
	<tr id="r_transmit_no_1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_1"><?php echo $document_log->transmit_no_1->caption() ?></span></td>
		<td data-name="transmit_no_1"<?php echo $document_log->transmit_no_1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_1">
<span<?php echo $document_log->transmit_no_1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_1->Visible) { // approval_status_1 ?>
	<tr id="r_approval_status_1">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_1"><?php echo $document_log->approval_status_1->caption() ?></span></td>
		<td data-name="approval_status_1"<?php echo $document_log->approval_status_1->cellAttributes() ?>>
<span id="el_document_log_approval_status_1">
<span<?php echo $document_log->approval_status_1->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_1->getViewValue())) && $document_log->approval_status_1->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_1->linkAttributes() ?>><?php echo $document_log->approval_status_1->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_1->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_2->Visible) { // submit_no_2 ?>
	<tr id="r_submit_no_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_2"><?php echo $document_log->submit_no_2->caption() ?></span></td>
		<td data-name="submit_no_2"<?php echo $document_log->submit_no_2->cellAttributes() ?>>
<span id="el_document_log_submit_no_2">
<span<?php echo $document_log->submit_no_2->viewAttributes() ?>>
<?php echo $document_log->submit_no_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_2->Visible) { // revision_no_2 ?>
	<tr id="r_revision_no_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_2"><?php echo $document_log->revision_no_2->caption() ?></span></td>
		<td data-name="revision_no_2"<?php echo $document_log->revision_no_2->cellAttributes() ?>>
<span id="el_document_log_revision_no_2">
<span<?php echo $document_log->revision_no_2->viewAttributes() ?>>
<?php echo $document_log->revision_no_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_2->Visible) { // direction_2 ?>
	<tr id="r_direction_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_2"><?php echo $document_log->direction_2->caption() ?></span></td>
		<td data-name="direction_2"<?php echo $document_log->direction_2->cellAttributes() ?>>
<span id="el_document_log_direction_2">
<span<?php echo $document_log->direction_2->viewAttributes() ?>>
<?php echo $document_log->direction_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_2->Visible) { // planned_date_2 ?>
	<tr id="r_planned_date_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_2"><?php echo $document_log->planned_date_2->caption() ?></span></td>
		<td data-name="planned_date_2"<?php echo $document_log->planned_date_2->cellAttributes() ?>>
<span id="el_document_log_planned_date_2">
<span<?php echo $document_log->planned_date_2->viewAttributes() ?>>
<?php echo $document_log->planned_date_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_2->Visible) { // transmit_date_2 ?>
	<tr id="r_transmit_date_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_2"><?php echo $document_log->transmit_date_2->caption() ?></span></td>
		<td data-name="transmit_date_2"<?php echo $document_log->transmit_date_2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_2">
<span<?php echo $document_log->transmit_date_2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_2->Visible) { // transmit_no_2 ?>
	<tr id="r_transmit_no_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_2"><?php echo $document_log->transmit_no_2->caption() ?></span></td>
		<td data-name="transmit_no_2"<?php echo $document_log->transmit_no_2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_2">
<span<?php echo $document_log->transmit_no_2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_2->Visible) { // approval_status_2 ?>
	<tr id="r_approval_status_2">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_2"><?php echo $document_log->approval_status_2->caption() ?></span></td>
		<td data-name="approval_status_2"<?php echo $document_log->approval_status_2->cellAttributes() ?>>
<span id="el_document_log_approval_status_2">
<span<?php echo $document_log->approval_status_2->viewAttributes() ?>>
<?php echo $document_log->approval_status_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_3->Visible) { // submit_no_3 ?>
	<tr id="r_submit_no_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_3"><?php echo $document_log->submit_no_3->caption() ?></span></td>
		<td data-name="submit_no_3"<?php echo $document_log->submit_no_3->cellAttributes() ?>>
<span id="el_document_log_submit_no_3">
<span<?php echo $document_log->submit_no_3->viewAttributes() ?>>
<?php echo $document_log->submit_no_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_3->Visible) { // revision_no_3 ?>
	<tr id="r_revision_no_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_3"><?php echo $document_log->revision_no_3->caption() ?></span></td>
		<td data-name="revision_no_3"<?php echo $document_log->revision_no_3->cellAttributes() ?>>
<span id="el_document_log_revision_no_3">
<span<?php echo $document_log->revision_no_3->viewAttributes() ?>>
<?php echo $document_log->revision_no_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_3->Visible) { // direction_3 ?>
	<tr id="r_direction_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_3"><?php echo $document_log->direction_3->caption() ?></span></td>
		<td data-name="direction_3"<?php echo $document_log->direction_3->cellAttributes() ?>>
<span id="el_document_log_direction_3">
<span<?php echo $document_log->direction_3->viewAttributes() ?>>
<?php echo $document_log->direction_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_3->Visible) { // planned_date_3 ?>
	<tr id="r_planned_date_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_3"><?php echo $document_log->planned_date_3->caption() ?></span></td>
		<td data-name="planned_date_3"<?php echo $document_log->planned_date_3->cellAttributes() ?>>
<span id="el_document_log_planned_date_3">
<span<?php echo $document_log->planned_date_3->viewAttributes() ?>>
<?php echo $document_log->planned_date_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_3->Visible) { // transmit_date_3 ?>
	<tr id="r_transmit_date_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_3"><?php echo $document_log->transmit_date_3->caption() ?></span></td>
		<td data-name="transmit_date_3"<?php echo $document_log->transmit_date_3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_3">
<span<?php echo $document_log->transmit_date_3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_3->Visible) { // transmit_no_3 ?>
	<tr id="r_transmit_no_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_3"><?php echo $document_log->transmit_no_3->caption() ?></span></td>
		<td data-name="transmit_no_3"<?php echo $document_log->transmit_no_3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_3">
<span<?php echo $document_log->transmit_no_3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_3->Visible) { // approval_status_3 ?>
	<tr id="r_approval_status_3">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_3"><?php echo $document_log->approval_status_3->caption() ?></span></td>
		<td data-name="approval_status_3"<?php echo $document_log->approval_status_3->cellAttributes() ?>>
<span id="el_document_log_approval_status_3">
<span<?php echo $document_log->approval_status_3->viewAttributes() ?>>
<?php echo $document_log->approval_status_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_4->Visible) { // submit_no_4 ?>
	<tr id="r_submit_no_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_4"><?php echo $document_log->submit_no_4->caption() ?></span></td>
		<td data-name="submit_no_4"<?php echo $document_log->submit_no_4->cellAttributes() ?>>
<span id="el_document_log_submit_no_4">
<span<?php echo $document_log->submit_no_4->viewAttributes() ?>>
<?php echo $document_log->submit_no_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_4->Visible) { // revision_no_4 ?>
	<tr id="r_revision_no_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_4"><?php echo $document_log->revision_no_4->caption() ?></span></td>
		<td data-name="revision_no_4"<?php echo $document_log->revision_no_4->cellAttributes() ?>>
<span id="el_document_log_revision_no_4">
<span<?php echo $document_log->revision_no_4->viewAttributes() ?>>
<?php echo $document_log->revision_no_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_4->Visible) { // direction_4 ?>
	<tr id="r_direction_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_4"><?php echo $document_log->direction_4->caption() ?></span></td>
		<td data-name="direction_4"<?php echo $document_log->direction_4->cellAttributes() ?>>
<span id="el_document_log_direction_4">
<span<?php echo $document_log->direction_4->viewAttributes() ?>>
<?php echo $document_log->direction_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_4->Visible) { // planned_date_4 ?>
	<tr id="r_planned_date_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_4"><?php echo $document_log->planned_date_4->caption() ?></span></td>
		<td data-name="planned_date_4"<?php echo $document_log->planned_date_4->cellAttributes() ?>>
<span id="el_document_log_planned_date_4">
<span<?php echo $document_log->planned_date_4->viewAttributes() ?>>
<?php echo $document_log->planned_date_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_4->Visible) { // transmit_date_4 ?>
	<tr id="r_transmit_date_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_4"><?php echo $document_log->transmit_date_4->caption() ?></span></td>
		<td data-name="transmit_date_4"<?php echo $document_log->transmit_date_4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_4">
<span<?php echo $document_log->transmit_date_4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_4->Visible) { // transmit_no_4 ?>
	<tr id="r_transmit_no_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_4"><?php echo $document_log->transmit_no_4->caption() ?></span></td>
		<td data-name="transmit_no_4"<?php echo $document_log->transmit_no_4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_4">
<span<?php echo $document_log->transmit_no_4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_4->Visible) { // approval_status_4 ?>
	<tr id="r_approval_status_4">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_4"><?php echo $document_log->approval_status_4->caption() ?></span></td>
		<td data-name="approval_status_4"<?php echo $document_log->approval_status_4->cellAttributes() ?>>
<span id="el_document_log_approval_status_4">
<span<?php echo $document_log->approval_status_4->viewAttributes() ?>>
<?php echo $document_log->approval_status_4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_5->Visible) { // submit_no_5 ?>
	<tr id="r_submit_no_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_5"><?php echo $document_log->submit_no_5->caption() ?></span></td>
		<td data-name="submit_no_5"<?php echo $document_log->submit_no_5->cellAttributes() ?>>
<span id="el_document_log_submit_no_5">
<span<?php echo $document_log->submit_no_5->viewAttributes() ?>>
<?php echo $document_log->submit_no_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_5->Visible) { // revision_no_5 ?>
	<tr id="r_revision_no_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_5"><?php echo $document_log->revision_no_5->caption() ?></span></td>
		<td data-name="revision_no_5"<?php echo $document_log->revision_no_5->cellAttributes() ?>>
<span id="el_document_log_revision_no_5">
<span<?php echo $document_log->revision_no_5->viewAttributes() ?>>
<?php echo $document_log->revision_no_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_5->Visible) { // direction_5 ?>
	<tr id="r_direction_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_5"><?php echo $document_log->direction_5->caption() ?></span></td>
		<td data-name="direction_5"<?php echo $document_log->direction_5->cellAttributes() ?>>
<span id="el_document_log_direction_5">
<span<?php echo $document_log->direction_5->viewAttributes() ?>>
<?php echo $document_log->direction_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_5->Visible) { // planned_date_5 ?>
	<tr id="r_planned_date_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_5"><?php echo $document_log->planned_date_5->caption() ?></span></td>
		<td data-name="planned_date_5"<?php echo $document_log->planned_date_5->cellAttributes() ?>>
<span id="el_document_log_planned_date_5">
<span<?php echo $document_log->planned_date_5->viewAttributes() ?>>
<?php echo $document_log->planned_date_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_5->Visible) { // transmit_date_5 ?>
	<tr id="r_transmit_date_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_5"><?php echo $document_log->transmit_date_5->caption() ?></span></td>
		<td data-name="transmit_date_5"<?php echo $document_log->transmit_date_5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_5">
<span<?php echo $document_log->transmit_date_5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_5->Visible) { // transmit_no_5 ?>
	<tr id="r_transmit_no_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_5"><?php echo $document_log->transmit_no_5->caption() ?></span></td>
		<td data-name="transmit_no_5"<?php echo $document_log->transmit_no_5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_5">
<span<?php echo $document_log->transmit_no_5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_5->Visible) { // approval_status_5 ?>
	<tr id="r_approval_status_5">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_5"><?php echo $document_log->approval_status_5->caption() ?></span></td>
		<td data-name="approval_status_5"<?php echo $document_log->approval_status_5->cellAttributes() ?>>
<span id="el_document_log_approval_status_5">
<span<?php echo $document_log->approval_status_5->viewAttributes() ?>>
<?php echo $document_log->approval_status_5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_6->Visible) { // submit_no_6 ?>
	<tr id="r_submit_no_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_6"><?php echo $document_log->submit_no_6->caption() ?></span></td>
		<td data-name="submit_no_6"<?php echo $document_log->submit_no_6->cellAttributes() ?>>
<span id="el_document_log_submit_no_6">
<span<?php echo $document_log->submit_no_6->viewAttributes() ?>>
<?php echo $document_log->submit_no_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_6->Visible) { // revision_no_6 ?>
	<tr id="r_revision_no_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_6"><?php echo $document_log->revision_no_6->caption() ?></span></td>
		<td data-name="revision_no_6"<?php echo $document_log->revision_no_6->cellAttributes() ?>>
<span id="el_document_log_revision_no_6">
<span<?php echo $document_log->revision_no_6->viewAttributes() ?>>
<?php echo $document_log->revision_no_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_6->Visible) { // direction_6 ?>
	<tr id="r_direction_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_6"><?php echo $document_log->direction_6->caption() ?></span></td>
		<td data-name="direction_6"<?php echo $document_log->direction_6->cellAttributes() ?>>
<span id="el_document_log_direction_6">
<span<?php echo $document_log->direction_6->viewAttributes() ?>>
<?php echo $document_log->direction_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_6->Visible) { // planned_date_6 ?>
	<tr id="r_planned_date_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_6"><?php echo $document_log->planned_date_6->caption() ?></span></td>
		<td data-name="planned_date_6"<?php echo $document_log->planned_date_6->cellAttributes() ?>>
<span id="el_document_log_planned_date_6">
<span<?php echo $document_log->planned_date_6->viewAttributes() ?>>
<?php echo $document_log->planned_date_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_6->Visible) { // transmit_date_6 ?>
	<tr id="r_transmit_date_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_6"><?php echo $document_log->transmit_date_6->caption() ?></span></td>
		<td data-name="transmit_date_6"<?php echo $document_log->transmit_date_6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_6">
<span<?php echo $document_log->transmit_date_6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_6->Visible) { // transmit_no_6 ?>
	<tr id="r_transmit_no_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_6"><?php echo $document_log->transmit_no_6->caption() ?></span></td>
		<td data-name="transmit_no_6"<?php echo $document_log->transmit_no_6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_6">
<span<?php echo $document_log->transmit_no_6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_6->Visible) { // approval_status_6 ?>
	<tr id="r_approval_status_6">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_6"><?php echo $document_log->approval_status_6->caption() ?></span></td>
		<td data-name="approval_status_6"<?php echo $document_log->approval_status_6->cellAttributes() ?>>
<span id="el_document_log_approval_status_6">
<span<?php echo $document_log->approval_status_6->viewAttributes() ?>>
<?php echo $document_log->approval_status_6->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_7->Visible) { // submit_no_7 ?>
	<tr id="r_submit_no_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_7"><?php echo $document_log->submit_no_7->caption() ?></span></td>
		<td data-name="submit_no_7"<?php echo $document_log->submit_no_7->cellAttributes() ?>>
<span id="el_document_log_submit_no_7">
<span<?php echo $document_log->submit_no_7->viewAttributes() ?>>
<?php echo $document_log->submit_no_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_7->Visible) { // revision_no_7 ?>
	<tr id="r_revision_no_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_7"><?php echo $document_log->revision_no_7->caption() ?></span></td>
		<td data-name="revision_no_7"<?php echo $document_log->revision_no_7->cellAttributes() ?>>
<span id="el_document_log_revision_no_7">
<span<?php echo $document_log->revision_no_7->viewAttributes() ?>>
<?php echo $document_log->revision_no_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_7->Visible) { // direction_7 ?>
	<tr id="r_direction_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_7"><?php echo $document_log->direction_7->caption() ?></span></td>
		<td data-name="direction_7"<?php echo $document_log->direction_7->cellAttributes() ?>>
<span id="el_document_log_direction_7">
<span<?php echo $document_log->direction_7->viewAttributes() ?>>
<?php echo $document_log->direction_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_7->Visible) { // planned_date_7 ?>
	<tr id="r_planned_date_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_7"><?php echo $document_log->planned_date_7->caption() ?></span></td>
		<td data-name="planned_date_7"<?php echo $document_log->planned_date_7->cellAttributes() ?>>
<span id="el_document_log_planned_date_7">
<span<?php echo $document_log->planned_date_7->viewAttributes() ?>>
<?php echo $document_log->planned_date_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_7->Visible) { // transmit_date_7 ?>
	<tr id="r_transmit_date_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_7"><?php echo $document_log->transmit_date_7->caption() ?></span></td>
		<td data-name="transmit_date_7"<?php echo $document_log->transmit_date_7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_7">
<span<?php echo $document_log->transmit_date_7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_7->Visible) { // transmit_no_7 ?>
	<tr id="r_transmit_no_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_7"><?php echo $document_log->transmit_no_7->caption() ?></span></td>
		<td data-name="transmit_no_7"<?php echo $document_log->transmit_no_7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_7">
<span<?php echo $document_log->transmit_no_7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_7->Visible) { // approval_status_7 ?>
	<tr id="r_approval_status_7">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_7"><?php echo $document_log->approval_status_7->caption() ?></span></td>
		<td data-name="approval_status_7"<?php echo $document_log->approval_status_7->cellAttributes() ?>>
<span id="el_document_log_approval_status_7">
<span<?php echo $document_log->approval_status_7->viewAttributes() ?>>
<?php echo $document_log->approval_status_7->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_8->Visible) { // submit_no_8 ?>
	<tr id="r_submit_no_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_8"><?php echo $document_log->submit_no_8->caption() ?></span></td>
		<td data-name="submit_no_8"<?php echo $document_log->submit_no_8->cellAttributes() ?>>
<span id="el_document_log_submit_no_8">
<span<?php echo $document_log->submit_no_8->viewAttributes() ?>>
<?php echo $document_log->submit_no_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_8->Visible) { // revision_no_8 ?>
	<tr id="r_revision_no_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_8"><?php echo $document_log->revision_no_8->caption() ?></span></td>
		<td data-name="revision_no_8"<?php echo $document_log->revision_no_8->cellAttributes() ?>>
<span id="el_document_log_revision_no_8">
<span<?php echo $document_log->revision_no_8->viewAttributes() ?>>
<?php echo $document_log->revision_no_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_8->Visible) { // direction_8 ?>
	<tr id="r_direction_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_8"><?php echo $document_log->direction_8->caption() ?></span></td>
		<td data-name="direction_8"<?php echo $document_log->direction_8->cellAttributes() ?>>
<span id="el_document_log_direction_8">
<span<?php echo $document_log->direction_8->viewAttributes() ?>>
<?php echo $document_log->direction_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_8->Visible) { // planned_date_8 ?>
	<tr id="r_planned_date_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_8"><?php echo $document_log->planned_date_8->caption() ?></span></td>
		<td data-name="planned_date_8"<?php echo $document_log->planned_date_8->cellAttributes() ?>>
<span id="el_document_log_planned_date_8">
<span<?php echo $document_log->planned_date_8->viewAttributes() ?>>
<?php echo $document_log->planned_date_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_8->Visible) { // transmit_date_8 ?>
	<tr id="r_transmit_date_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_8"><?php echo $document_log->transmit_date_8->caption() ?></span></td>
		<td data-name="transmit_date_8"<?php echo $document_log->transmit_date_8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_8">
<span<?php echo $document_log->transmit_date_8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_8->Visible) { // transmit_no_8 ?>
	<tr id="r_transmit_no_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_8"><?php echo $document_log->transmit_no_8->caption() ?></span></td>
		<td data-name="transmit_no_8"<?php echo $document_log->transmit_no_8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_8">
<span<?php echo $document_log->transmit_no_8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_8->Visible) { // approval_status_8 ?>
	<tr id="r_approval_status_8">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_8"><?php echo $document_log->approval_status_8->caption() ?></span></td>
		<td data-name="approval_status_8"<?php echo $document_log->approval_status_8->cellAttributes() ?>>
<span id="el_document_log_approval_status_8">
<span<?php echo $document_log->approval_status_8->viewAttributes() ?>>
<?php echo $document_log->approval_status_8->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_9->Visible) { // submit_no_9 ?>
	<tr id="r_submit_no_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_9"><?php echo $document_log->submit_no_9->caption() ?></span></td>
		<td data-name="submit_no_9"<?php echo $document_log->submit_no_9->cellAttributes() ?>>
<span id="el_document_log_submit_no_9">
<span<?php echo $document_log->submit_no_9->viewAttributes() ?>>
<?php echo $document_log->submit_no_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_9->Visible) { // revision_no_9 ?>
	<tr id="r_revision_no_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_9"><?php echo $document_log->revision_no_9->caption() ?></span></td>
		<td data-name="revision_no_9"<?php echo $document_log->revision_no_9->cellAttributes() ?>>
<span id="el_document_log_revision_no_9">
<span<?php echo $document_log->revision_no_9->viewAttributes() ?>>
<?php echo $document_log->revision_no_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_9->Visible) { // direction_9 ?>
	<tr id="r_direction_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_9"><?php echo $document_log->direction_9->caption() ?></span></td>
		<td data-name="direction_9"<?php echo $document_log->direction_9->cellAttributes() ?>>
<span id="el_document_log_direction_9">
<span<?php echo $document_log->direction_9->viewAttributes() ?>>
<?php echo $document_log->direction_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_9->Visible) { // planned_date_9 ?>
	<tr id="r_planned_date_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_9"><?php echo $document_log->planned_date_9->caption() ?></span></td>
		<td data-name="planned_date_9"<?php echo $document_log->planned_date_9->cellAttributes() ?>>
<span id="el_document_log_planned_date_9">
<span<?php echo $document_log->planned_date_9->viewAttributes() ?>>
<?php echo $document_log->planned_date_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_9->Visible) { // transmit_date_9 ?>
	<tr id="r_transmit_date_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_9"><?php echo $document_log->transmit_date_9->caption() ?></span></td>
		<td data-name="transmit_date_9"<?php echo $document_log->transmit_date_9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_9">
<span<?php echo $document_log->transmit_date_9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_9->Visible) { // transmit_no_9 ?>
	<tr id="r_transmit_no_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_9"><?php echo $document_log->transmit_no_9->caption() ?></span></td>
		<td data-name="transmit_no_9"<?php echo $document_log->transmit_no_9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_9">
<span<?php echo $document_log->transmit_no_9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_9->Visible) { // approval_status_9 ?>
	<tr id="r_approval_status_9">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_9"><?php echo $document_log->approval_status_9->caption() ?></span></td>
		<td data-name="approval_status_9"<?php echo $document_log->approval_status_9->cellAttributes() ?>>
<span id="el_document_log_approval_status_9">
<span<?php echo $document_log->approval_status_9->viewAttributes() ?>>
<?php echo $document_log->approval_status_9->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->submit_no_10->Visible) { // submit_no_10 ?>
	<tr id="r_submit_no_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_10"><?php echo $document_log->submit_no_10->caption() ?></span></td>
		<td data-name="submit_no_10"<?php echo $document_log->submit_no_10->cellAttributes() ?>>
<span id="el_document_log_submit_no_10">
<span<?php echo $document_log->submit_no_10->viewAttributes() ?>>
<?php echo $document_log->submit_no_10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->revision_no_10->Visible) { // revision_no_10 ?>
	<tr id="r_revision_no_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_10"><?php echo $document_log->revision_no_10->caption() ?></span></td>
		<td data-name="revision_no_10"<?php echo $document_log->revision_no_10->cellAttributes() ?>>
<span id="el_document_log_revision_no_10">
<span<?php echo $document_log->revision_no_10->viewAttributes() ?>>
<?php echo $document_log->revision_no_10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->direction_10->Visible) { // direction_10 ?>
	<tr id="r_direction_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_direction_10"><?php echo $document_log->direction_10->caption() ?></span></td>
		<td data-name="direction_10"<?php echo $document_log->direction_10->cellAttributes() ?>>
<span id="el_document_log_direction_10">
<span<?php echo $document_log->direction_10->viewAttributes() ?>>
<?php echo $document_log->direction_10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->planned_date_10->Visible) { // planned_date_10 ?>
	<tr id="r_planned_date_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_10"><?php echo $document_log->planned_date_10->caption() ?></span></td>
		<td data-name="planned_date_10"<?php echo $document_log->planned_date_10->cellAttributes() ?>>
<span id="el_document_log_planned_date_10">
<span<?php echo $document_log->planned_date_10->viewAttributes() ?>>
<?php echo $document_log->planned_date_10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_date_10->Visible) { // transmit_date_10 ?>
	<tr id="r_transmit_date_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_10"><?php echo $document_log->transmit_date_10->caption() ?></span></td>
		<td data-name="transmit_date_10"<?php echo $document_log->transmit_date_10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_10">
<span<?php echo $document_log->transmit_date_10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->transmit_no_10->Visible) { // transmit_no_10 ?>
	<tr id="r_transmit_no_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_10"><?php echo $document_log->transmit_no_10->caption() ?></span></td>
		<td data-name="transmit_no_10"<?php echo $document_log->transmit_no_10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_10">
<span<?php echo $document_log->transmit_no_10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_10->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_log->approval_status_10->Visible) { // approval_status_10 ?>
	<tr id="r_approval_status_10">
		<td class="<?php echo $document_log_view->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_10"><?php echo $document_log->approval_status_10->caption() ?></span></td>
		<td data-name="approval_status_10"<?php echo $document_log->approval_status_10->cellAttributes() ?>>
<span id="el_document_log_approval_status_10">
<span<?php echo $document_log->approval_status_10->viewAttributes() ?>>
<?php echo $document_log->approval_status_10->getViewValue() ?></span>
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