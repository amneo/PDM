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
$document_type_view = new document_type_view();

// Run the page
$document_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_type_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_type->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdocument_typeview = currentForm = new ew.Form("fdocument_typeview", "view");

// Form_CustomValidate event
fdocument_typeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_typeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_type->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $document_type_view->ExportOptions->render("body") ?>
<?php $document_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $document_type_view->showPageHeader(); ?>
<?php
$document_type_view->showMessage();
?>
<?php if (!$document_type_view->IsModal) { ?>
<?php if (!$document_type->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_type_view->Pager)) $document_type_view->Pager = new NumericPager($document_type_view->StartRec, $document_type_view->DisplayRecs, $document_type_view->TotalRecs, $document_type_view->RecRange, $document_type_view->AutoHidePager) ?>
<?php if ($document_type_view->Pager->RecordCount > 0 && $document_type_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_type_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_type_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_type_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_type_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_type_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_type_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdocument_typeview" id="fdocument_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_type_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_type_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_type">
<input type="hidden" name="modal" value="<?php echo (int)$document_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($document_type->type_id->Visible) { // type_id ?>
	<tr id="r_type_id">
		<td class="<?php echo $document_type_view->TableLeftColumnClass ?>"><span id="elh_document_type_type_id"><?php echo $document_type->type_id->caption() ?></span></td>
		<td data-name="type_id"<?php echo $document_type->type_id->cellAttributes() ?>>
<span id="el_document_type_type_id">
<span<?php echo $document_type->type_id->viewAttributes() ?>>
<?php echo $document_type->type_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_type->document_type->Visible) { // document_type ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_type_view->TableLeftColumnClass ?>"><span id="elh_document_type_document_type"><?php echo $document_type->document_type->caption() ?></span></td>
		<td data-name="document_type"<?php echo $document_type->document_type->cellAttributes() ?>>
<span id="el_document_type_document_type">
<span<?php echo $document_type->document_type->viewAttributes() ?>>
<?php echo $document_type->document_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_type->document_category->Visible) { // document_category ?>
	<tr id="r_document_category">
		<td class="<?php echo $document_type_view->TableLeftColumnClass ?>"><span id="elh_document_type_document_category"><?php echo $document_type->document_category->caption() ?></span></td>
		<td data-name="document_category"<?php echo $document_type->document_category->cellAttributes() ?>>
<span id="el_document_type_document_category">
<span<?php echo $document_type->document_category->viewAttributes() ?>>
<?php echo $document_type->document_category->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$document_type_view->IsModal) { ?>
<?php if (!$document_type->isExport()) { ?>
<?php if (!isset($document_type_view->Pager)) $document_type_view->Pager = new NumericPager($document_type_view->StartRec, $document_type_view->DisplayRecs, $document_type_view->TotalRecs, $document_type_view->RecRange, $document_type_view->AutoHidePager) ?>
<?php if ($document_type_view->Pager->RecordCount > 0 && $document_type_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_type_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_type_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_type_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_type_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_type_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_type_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_view->pageUrl() ?>start=<?php echo $document_type_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$document_type_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_type->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_type_view->terminate();
?>