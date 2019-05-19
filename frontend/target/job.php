<?php
namespace PHPMaker2019\pdm; // Don't forget to always use namespace this since v2019; adjust it to yours!
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
require_once "autoload.php"; // Everything is in here, so easy, right? :-)
echo "The values is: " . ExecuteScalar("truncate document_log"); // Display it whatever the result is
echo "The values is: " . ExecuteScalar("select om_func_03();"); // Display it whatever the result is
?>