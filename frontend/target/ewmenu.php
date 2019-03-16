<?php
namespace PHPMaker2019\pdm;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(18, "mci_Workplace", $MenuLanguage->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(1, "mi_transaction_details", $MenuLanguage->MenuPhrase("1", "MenuText"), "transaction_detailslist.php", 18, "", AllowListMenu('vishal-pdmtransaction_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(7, "mi_transmit_details", $MenuLanguage->MenuPhrase("7", "MenuText"), "transmit_detailslist.php", 18, "", AllowListMenu('vishal-pdmtransmit_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10, "mci_Masters", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(5, "mi_project_details", $MenuLanguage->MenuPhrase("5", "MenuText"), "project_detailslist.php", 10, "", AllowListMenu('vishal-pdmproject_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(4, "mi_document_details", $MenuLanguage->MenuPhrase("4", "MenuText"), "document_detailslist.php", 10, "", AllowListMenu('vishal-pdmdocument_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_distribution_details", $MenuLanguage->MenuPhrase("2", "MenuText"), "distribution_detailslist.php", 10, "", AllowListMenu('vishal-pdmdistribution_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(9, "mi_user_dtls", $MenuLanguage->MenuPhrase("9", "MenuText"), "user_dtlslist.php", 10, "", AllowListMenu('vishal-pdmuser_dtls'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(20, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("20", "MenuText"), "userlevelpermissionslist.php", 10, "", AllowListMenu('vishal-pdmuserlevelpermissions'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(21, "mi_userlevels", $MenuLanguage->MenuPhrase("21", "MenuText"), "userlevelslist.php", 10, "", AllowListMenu('vishal-pdmuserlevels'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(8, "mi_audittrail", $MenuLanguage->MenuPhrase("8", "MenuText"), "audittraillist.php", 10, "", AllowListMenu('vishal-pdmaudittrail'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(3, "mi_inbox", $MenuLanguage->MenuPhrase("3", "MenuText"), "inboxlist.php", 10, "", AllowListMenu('vishal-pdminbox'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(19, "mi_approval_details", $MenuLanguage->MenuPhrase("19", "MenuText"), "approval_detailslist.php", 10, "", AllowListMenu('vishal-pdmapproval_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(6, "mi_app_version", $MenuLanguage->MenuPhrase("6", "MenuText"), "app_versionlist.php", 10, "", AllowListMenu('vishal-pdmapp_version'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(32, "mci_Reports", $MenuLanguage->MenuPhrase("32", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(18, "mci_Workplace", $MenuLanguage->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(1, "mi_transaction_details", $MenuLanguage->MenuPhrase("1", "MenuText"), "transaction_detailslist.php", 18, "", AllowListMenu('vishal-pdmtransaction_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(7, "mi_transmit_details", $MenuLanguage->MenuPhrase("7", "MenuText"), "transmit_detailslist.php", 18, "", AllowListMenu('vishal-pdmtransmit_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10, "mci_Masters", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(5, "mi_project_details", $MenuLanguage->MenuPhrase("5", "MenuText"), "project_detailslist.php", 10, "", AllowListMenu('vishal-pdmproject_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(4, "mi_document_details", $MenuLanguage->MenuPhrase("4", "MenuText"), "document_detailslist.php", 10, "", AllowListMenu('vishal-pdmdocument_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_distribution_details", $MenuLanguage->MenuPhrase("2", "MenuText"), "distribution_detailslist.php", 10, "", AllowListMenu('vishal-pdmdistribution_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(9, "mi_user_dtls", $MenuLanguage->MenuPhrase("9", "MenuText"), "user_dtlslist.php", 10, "", AllowListMenu('vishal-pdmuser_dtls'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(20, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("20", "MenuText"), "userlevelpermissionslist.php", 10, "", AllowListMenu('vishal-pdmuserlevelpermissions'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(21, "mi_userlevels", $MenuLanguage->MenuPhrase("21", "MenuText"), "userlevelslist.php", 10, "", AllowListMenu('vishal-pdmuserlevels'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(8, "mi_audittrail", $MenuLanguage->MenuPhrase("8", "MenuText"), "audittraillist.php", 10, "", AllowListMenu('vishal-pdmaudittrail'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_inbox", $MenuLanguage->MenuPhrase("3", "MenuText"), "inboxlist.php", 10, "", AllowListMenu('vishal-pdminbox'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(19, "mi_approval_details", $MenuLanguage->MenuPhrase("19", "MenuText"), "approval_detailslist.php", 10, "", AllowListMenu('vishal-pdmapproval_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(6, "mi_app_version", $MenuLanguage->MenuPhrase("6", "MenuText"), "app_versionlist.php", 10, "", AllowListMenu('vishal-pdmapp_version'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(32, "mci_Reports", $MenuLanguage->MenuPhrase("32", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", TRUE);
echo $sideMenu->toScript();
?>