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
$app_version_view = new app_version_view();

// Run the page
$app_version_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_version_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$app_version->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fapp_versionview = currentForm = new ew.Form("fapp_versionview", "view");

// Form_CustomValidate event
fapp_versionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapp_versionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$app_version->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $app_version_view->ExportOptions->render("body") ?>
<?php $app_version_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $app_version_view->showPageHeader(); ?>
<?php
$app_version_view->showMessage();
?>
<?php if (!$app_version_view->IsModal) { ?>
<?php if (!$app_version->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($app_version_view->Pager)) $app_version_view->Pager = new NumericPager($app_version_view->StartRec, $app_version_view->DisplayRecs, $app_version_view->TotalRecs, $app_version_view->RecRange, $app_version_view->AutoHidePager) ?>
<?php if ($app_version_view->Pager->RecordCount > 0 && $app_version_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($app_version_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($app_version_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($app_version_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $app_version_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($app_version_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($app_version_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fapp_versionview" id="fapp_versionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($app_version_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $app_version_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_version">
<input type="hidden" name="modal" value="<?php echo (int)$app_version_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
</table>
<?php if (!$app_version_view->IsModal) { ?>
<?php if (!$app_version->isExport()) { ?>
<?php if (!isset($app_version_view->Pager)) $app_version_view->Pager = new NumericPager($app_version_view->StartRec, $app_version_view->DisplayRecs, $app_version_view->TotalRecs, $app_version_view->RecRange, $app_version_view->AutoHidePager) ?>
<?php if ($app_version_view->Pager->RecordCount > 0 && $app_version_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($app_version_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($app_version_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($app_version_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $app_version_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($app_version_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($app_version_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_view->pageUrl() ?>start=<?php echo $app_version_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$app_version_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$app_version->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$app_version_view->terminate();
?>