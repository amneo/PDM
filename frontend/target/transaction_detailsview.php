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
$transaction_details_view = new transaction_details_view();

// Run the page
$transaction_details_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$transaction_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftransaction_detailsview = currentForm = new ew.Form("ftransaction_detailsview", "view");

// Form_CustomValidate event
ftransaction_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransaction_detailsview.lists["x_firelink_doc_no"] = <?php echo $transaction_details_view->firelink_doc_no->Lookup->toClientList() ?>;
ftransaction_detailsview.lists["x_firelink_doc_no"].options = <?php echo JsonEncode($transaction_details_view->firelink_doc_no->lookupOptions()) ?>;
ftransaction_detailsview.autoSuggests["x_firelink_doc_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsview.lists["x_transmit_no"] = <?php echo $transaction_details_view->transmit_no->Lookup->toClientList() ?>;
ftransaction_detailsview.lists["x_transmit_no"].options = <?php echo JsonEncode($transaction_details_view->transmit_no->lookupOptions()) ?>;
ftransaction_detailsview.autoSuggests["x_transmit_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsview.lists["x_direction"] = <?php echo $transaction_details_view->direction->Lookup->toClientList() ?>;
ftransaction_detailsview.lists["x_direction"].options = <?php echo JsonEncode($transaction_details_view->direction->options(FALSE, TRUE)) ?>;
ftransaction_detailsview.lists["x_approval_status"] = <?php echo $transaction_details_view->approval_status->Lookup->toClientList() ?>;
ftransaction_detailsview.lists["x_approval_status"].options = <?php echo JsonEncode($transaction_details_view->approval_status->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$transaction_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $transaction_details_view->ExportOptions->render("body") ?>
<?php $transaction_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $transaction_details_view->showPageHeader(); ?>
<?php
$transaction_details_view->showMessage();
?>
<?php if (!$transaction_details_view->IsModal) { ?>
<?php if (!$transaction_details->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($transaction_details_view->Pager)) $transaction_details_view->Pager = new NumericPager($transaction_details_view->StartRec, $transaction_details_view->DisplayRecs, $transaction_details_view->TotalRecs, $transaction_details_view->RecRange, $transaction_details_view->AutoHidePager) ?>
<?php if ($transaction_details_view->Pager->RecordCount > 0 && $transaction_details_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transaction_details_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transaction_details_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transaction_details_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftransaction_detailsview" id="ftransaction_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<input type="hidden" name="modal" value="<?php echo (int)$transaction_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_firelink_doc_no"><?php echo $transaction_details->firelink_doc_no->caption() ?></span></td>
		<td data-name="firelink_doc_no"<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->firelink_doc_no->getViewValue())) && $transaction_details->firelink_doc_no->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->firelink_doc_no->linkAttributes() ?>><?php echo $transaction_details->firelink_doc_no->getViewValue() ?></a>
<?php } else { ?>
<?php echo $transaction_details->firelink_doc_no->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_project_name"><?php echo $transaction_details->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $transaction_details->project_name->cellAttributes() ?>>
<span id="el_transaction_details_project_name">
<span<?php echo $transaction_details->project_name->viewAttributes() ?>>
<?php echo $transaction_details->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->document_tittle->Visible) { // document_tittle ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_tittle"><?php echo $transaction_details->document_tittle->caption() ?></span></td>
		<td data-name="document_tittle"<?php echo $transaction_details->document_tittle->cellAttributes() ?>>
<span id="el_transaction_details_document_tittle">
<span<?php echo $transaction_details->document_tittle->viewAttributes() ?>>
<?php echo $transaction_details->document_tittle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
	<tr id="r_submit_no">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_submit_no"><?php echo $transaction_details->submit_no->caption() ?></span></td>
		<td data-name="submit_no"<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<?php echo $transaction_details->submit_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
	<tr id="r_revision_no">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_revision_no"><?php echo $transaction_details->revision_no->caption() ?></span></td>
		<td data-name="revision_no"<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<?php echo $transaction_details->revision_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
	<tr id="r_transmit_no">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_no"><?php echo $transaction_details->transmit_no->caption() ?></span></td>
		<td data-name="transmit_no"<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<?php echo $transaction_details->transmit_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
	<tr id="r_transmit_date">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_date"><?php echo $transaction_details->transmit_date->caption() ?></span></td>
		<td data-name="transmit_date"<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<?php echo $transaction_details->transmit_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->direction->Visible) { // direction ?>
	<tr id="r_direction">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_direction"><?php echo $transaction_details->direction->caption() ?></span></td>
		<td data-name="direction"<?php echo $transaction_details->direction->cellAttributes() ?>>
<span id="el_transaction_details_direction">
<span<?php echo $transaction_details->direction->viewAttributes() ?>>
<?php echo $transaction_details->direction->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
	<tr id="r_approval_status">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_approval_status"><?php echo $transaction_details->approval_status->caption() ?></span></td>
		<td data-name="approval_status"<?php echo $transaction_details->approval_status->cellAttributes() ?>>
<span id="el_transaction_details_approval_status">
<span<?php echo $transaction_details->approval_status->viewAttributes() ?>>
<?php echo $transaction_details->approval_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
	<tr id="r_document_native">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_native"><?php echo $transaction_details->document_native->caption() ?></span></td>
		<td data-name="document_native"<?php echo $transaction_details->document_native->cellAttributes() ?>>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<?php echo $transaction_details->document_native->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaction_details->expiry_date->Visible) { // expiry_date ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $transaction_details_view->TableLeftColumnClass ?>"><span id="elh_transaction_details_expiry_date"><?php echo $transaction_details->expiry_date->caption() ?></span></td>
		<td data-name="expiry_date"<?php echo $transaction_details->expiry_date->cellAttributes() ?>>
<span id="el_transaction_details_expiry_date">
<span<?php echo $transaction_details->expiry_date->viewAttributes() ?>>
<?php echo $transaction_details->expiry_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$transaction_details_view->IsModal) { ?>
<?php if (!$transaction_details->isExport()) { ?>
<?php if (!isset($transaction_details_view->Pager)) $transaction_details_view->Pager = new NumericPager($transaction_details_view->StartRec, $transaction_details_view->DisplayRecs, $transaction_details_view->TotalRecs, $transaction_details_view->RecRange, $transaction_details_view->AutoHidePager) ?>
<?php if ($transaction_details_view->Pager->RecordCount > 0 && $transaction_details_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transaction_details_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transaction_details_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transaction_details_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_view->pageUrl() ?>start=<?php echo $transaction_details_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$transaction_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$transaction_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$transaction_details_view->terminate();
?>