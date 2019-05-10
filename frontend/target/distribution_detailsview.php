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
$distribution_details_view = new distribution_details_view();

// Run the page
$distribution_details_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$distribution_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$distribution_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdistribution_detailsview = currentForm = new ew.Form("fdistribution_detailsview", "view");

// Form_CustomValidate event
fdistribution_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdistribution_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdistribution_detailsview.lists["x_project_name"] = <?php echo $distribution_details_view->project_name->Lookup->toClientList() ?>;
fdistribution_detailsview.lists["x_project_name"].options = <?php echo JsonEncode($distribution_details_view->project_name->lookupOptions()) ?>;
fdistribution_detailsview.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdistribution_detailsview.lists["x_distribution_valid"] = <?php echo $distribution_details_view->distribution_valid->Lookup->toClientList() ?>;
fdistribution_detailsview.lists["x_distribution_valid"].options = <?php echo JsonEncode($distribution_details_view->distribution_valid->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$distribution_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $distribution_details_view->ExportOptions->render("body") ?>
<?php $distribution_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $distribution_details_view->showPageHeader(); ?>
<?php
$distribution_details_view->showMessage();
?>
<?php if (!$distribution_details_view->IsModal) { ?>
<?php if (!$distribution_details->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($distribution_details_view->Pager)) $distribution_details_view->Pager = new NumericPager($distribution_details_view->StartRec, $distribution_details_view->DisplayRecs, $distribution_details_view->TotalRecs, $distribution_details_view->RecRange, $distribution_details_view->AutoHidePager) ?>
<?php if ($distribution_details_view->Pager->RecordCount > 0 && $distribution_details_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($distribution_details_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($distribution_details_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $distribution_details_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdistribution_detailsview" id="fdistribution_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($distribution_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $distribution_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="distribution_details">
<input type="hidden" name="modal" value="<?php echo (int)$distribution_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($distribution_details->to_Name->Visible) { // to_Name ?>
	<tr id="r_to_Name">
		<td class="<?php echo $distribution_details_view->TableLeftColumnClass ?>"><span id="elh_distribution_details_to_Name"><?php echo $distribution_details->to_Name->caption() ?></span></td>
		<td data-name="to_Name"<?php echo $distribution_details->to_Name->cellAttributes() ?>>
<span id="el_distribution_details_to_Name">
<span<?php echo $distribution_details->to_Name->viewAttributes() ?>>
<?php echo $distribution_details->to_Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($distribution_details->email_address->Visible) { // email_address ?>
	<tr id="r_email_address">
		<td class="<?php echo $distribution_details_view->TableLeftColumnClass ?>"><span id="elh_distribution_details_email_address"><?php echo $distribution_details->email_address->caption() ?></span></td>
		<td data-name="email_address"<?php echo $distribution_details->email_address->cellAttributes() ?>>
<span id="el_distribution_details_email_address">
<span<?php echo $distribution_details->email_address->viewAttributes() ?>>
<?php echo $distribution_details->email_address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($distribution_details->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $distribution_details_view->TableLeftColumnClass ?>"><span id="elh_distribution_details_project_name"><?php echo $distribution_details->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $distribution_details->project_name->cellAttributes() ?>>
<span id="el_distribution_details_project_name">
<span<?php echo $distribution_details->project_name->viewAttributes() ?>>
<?php echo $distribution_details->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($distribution_details->distribution_valid->Visible) { // distribution_valid ?>
	<tr id="r_distribution_valid">
		<td class="<?php echo $distribution_details_view->TableLeftColumnClass ?>"><span id="elh_distribution_details_distribution_valid"><?php echo $distribution_details->distribution_valid->caption() ?></span></td>
		<td data-name="distribution_valid"<?php echo $distribution_details->distribution_valid->cellAttributes() ?>>
<span id="el_distribution_details_distribution_valid">
<span<?php echo $distribution_details->distribution_valid->viewAttributes() ?>>
<?php echo $distribution_details->distribution_valid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$distribution_details_view->IsModal) { ?>
<?php if (!$distribution_details->isExport()) { ?>
<?php if (!isset($distribution_details_view->Pager)) $distribution_details_view->Pager = new NumericPager($distribution_details_view->StartRec, $distribution_details_view->DisplayRecs, $distribution_details_view->TotalRecs, $distribution_details_view->RecRange, $distribution_details_view->AutoHidePager) ?>
<?php if ($distribution_details_view->Pager->RecordCount > 0 && $distribution_details_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($distribution_details_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($distribution_details_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $distribution_details_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_view->pageUrl() ?>start=<?php echo $distribution_details_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$distribution_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$distribution_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$distribution_details_view->terminate();
?>