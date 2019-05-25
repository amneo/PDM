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
$transmit_details_view = new transmit_details_view();

// Run the page
$transmit_details_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$transmit_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftransmit_detailsview = currentForm = new ew.Form("ftransmit_detailsview", "view");

// Form_CustomValidate event
ftransmit_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$transmit_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $transmit_details_view->ExportOptions->render("body") ?>
<?php $transmit_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $transmit_details_view->showPageHeader(); ?>
<?php
$transmit_details_view->showMessage();
?>
<?php if (!$transmit_details_view->IsModal) { ?>
<?php if (!$transmit_details->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($transmit_details_view->Pager)) $transmit_details_view->Pager = new NumericPager($transmit_details_view->StartRec, $transmit_details_view->DisplayRecs, $transmit_details_view->TotalRecs, $transmit_details_view->RecRange, $transmit_details_view->AutoHidePager) ?>
<?php if ($transmit_details_view->Pager->RecordCount > 0 && $transmit_details_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transmit_details_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transmit_details_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transmit_details_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftransmit_detailsview" id="ftransmit_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transmit_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transmit_details">
<input type="hidden" name="modal" value="<?php echo (int)$transmit_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
</table>
<?php if (!$transmit_details_view->IsModal) { ?>
<?php if (!$transmit_details->isExport()) { ?>
<?php if (!isset($transmit_details_view->Pager)) $transmit_details_view->Pager = new NumericPager($transmit_details_view->StartRec, $transmit_details_view->DisplayRecs, $transmit_details_view->TotalRecs, $transmit_details_view->RecRange, $transmit_details_view->AutoHidePager) ?>
<?php if ($transmit_details_view->Pager->RecordCount > 0 && $transmit_details_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transmit_details_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transmit_details_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transmit_details_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_view->pageUrl() ?>start=<?php echo $transmit_details_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$transmit_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$transmit_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$transmit_details_view->terminate();
?>