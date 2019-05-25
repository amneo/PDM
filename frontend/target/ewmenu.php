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
$topMenu->addMenuItem(1, "mi_transaction_details", $MenuLanguage->MenuPhrase("1", "MenuText"), "transaction_detailslist.php", 18, "", AllowListMenu('{vishal-pdm}transaction_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(35, "mi_document_log", $MenuLanguage->MenuPhrase("35", "MenuText"), "document_loglist.php", 18, "", AllowListMenu('{vishal-pdm}document_log'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(7, "mi_transmit_details", $MenuLanguage->MenuPhrase("7", "MenuText"), "transmit_detailslist.php", 18, "", AllowListMenu('{vishal-pdm}transmit_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10, "mci_Masters", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(5, "mi_project_details", $MenuLanguage->MenuPhrase("5", "MenuText"), "project_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}project_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(4, "mi_document_details", $MenuLanguage->MenuPhrase("4", "MenuText"), "document_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}document_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_distribution_details", $MenuLanguage->MenuPhrase("2", "MenuText"), "distribution_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}distribution_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(38, "mi_users", $MenuLanguage->MenuPhrase("38", "MenuText"), "userslist.php", 10, "", AllowListMenu('{vishal-pdm}users'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(20, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("20", "MenuText"), "userlevelpermissionslist.php", 10, "", AllowListMenu('{vishal-pdm}userlevelpermissions'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(21, "mi_userlevels", $MenuLanguage->MenuPhrase("21", "MenuText"), "userlevelslist.php", 10, "", AllowListMenu('{vishal-pdm}userlevels'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(8, "mi_audittrail", $MenuLanguage->MenuPhrase("8", "MenuText"), "audittraillist.php", 10, "", AllowListMenu('{vishal-pdm}audittrail'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(3, "mi_inbox", $MenuLanguage->MenuPhrase("3", "MenuText"), "inboxlist.php", 10, "", AllowListMenu('{vishal-pdm}inbox'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(34, "mi_xmit_details", $MenuLanguage->MenuPhrase("34", "MenuText"), "xmit_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}xmit_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(19, "mi_approval_details", $MenuLanguage->MenuPhrase("19", "MenuText"), "approval_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}approval_details'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(33, "mi_document_system", $MenuLanguage->MenuPhrase("33", "MenuText"), "document_systemlist.php", 10, "", AllowListMenu('{vishal-pdm}document_system'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(37, "mi_document_type", $MenuLanguage->MenuPhrase("37", "MenuText"), "document_typelist.php", 10, "", AllowListMenu('{vishal-pdm}document_type'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(6, "mi_app_version", $MenuLanguage->MenuPhrase("6", "MenuText"), "app_versionlist.php", 10, "", AllowListMenu('{vishal-pdm}app_version'), FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(18, "mci_Workplace", $MenuLanguage->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(1, "mi_transaction_details", $MenuLanguage->MenuPhrase("1", "MenuText"), "transaction_detailslist.php", 18, "", AllowListMenu('{vishal-pdm}transaction_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(35, "mi_document_log", $MenuLanguage->MenuPhrase("35", "MenuText"), "document_loglist.php", 18, "", AllowListMenu('{vishal-pdm}document_log'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(7, "mi_transmit_details", $MenuLanguage->MenuPhrase("7", "MenuText"), "transmit_detailslist.php", 18, "", AllowListMenu('{vishal-pdm}transmit_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10, "mci_Masters", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(5, "mi_project_details", $MenuLanguage->MenuPhrase("5", "MenuText"), "project_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}project_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(4, "mi_document_details", $MenuLanguage->MenuPhrase("4", "MenuText"), "document_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}document_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_distribution_details", $MenuLanguage->MenuPhrase("2", "MenuText"), "distribution_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}distribution_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(38, "mi_users", $MenuLanguage->MenuPhrase("38", "MenuText"), "userslist.php", 10, "", AllowListMenu('{vishal-pdm}users'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(20, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("20", "MenuText"), "userlevelpermissionslist.php", 10, "", AllowListMenu('{vishal-pdm}userlevelpermissions'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(21, "mi_userlevels", $MenuLanguage->MenuPhrase("21", "MenuText"), "userlevelslist.php", 10, "", AllowListMenu('{vishal-pdm}userlevels'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(8, "mi_audittrail", $MenuLanguage->MenuPhrase("8", "MenuText"), "audittraillist.php", 10, "", AllowListMenu('{vishal-pdm}audittrail'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_inbox", $MenuLanguage->MenuPhrase("3", "MenuText"), "inboxlist.php", 10, "", AllowListMenu('{vishal-pdm}inbox'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(34, "mi_xmit_details", $MenuLanguage->MenuPhrase("34", "MenuText"), "xmit_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}xmit_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(19, "mi_approval_details", $MenuLanguage->MenuPhrase("19", "MenuText"), "approval_detailslist.php", 10, "", AllowListMenu('{vishal-pdm}approval_details'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(33, "mi_document_system", $MenuLanguage->MenuPhrase("33", "MenuText"), "document_systemlist.php", 10, "", AllowListMenu('{vishal-pdm}document_system'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(37, "mi_document_type", $MenuLanguage->MenuPhrase("37", "MenuText"), "document_typelist.php", 10, "", AllowListMenu('{vishal-pdm}document_type'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(6, "mi_app_version", $MenuLanguage->MenuPhrase("6", "MenuText"), "app_versionlist.php", 10, "", AllowListMenu('{vishal-pdm}app_version'), FALSE, FALSE, "", "", TRUE);
echo $sideMenu->toScript();
?>