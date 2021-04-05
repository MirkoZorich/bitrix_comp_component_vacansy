<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BN_P_IBLOCK"),
			"TYPE" => "STRING",
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_PROPERTY"),
			"TYPE" => "STRING",
			"VALUE" => ""
		),
		"CACHE_TIME"  =>  Array("DEFAULT" => 36000000),
	),
);
?>
