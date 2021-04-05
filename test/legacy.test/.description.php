<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_VACANSY_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_VACANSY_DESCRIPTION"),
	"ICON" => "",
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "legacy",
		"CHILD" => array(
			"ID" => "legacy.test",
			"NAME" => GetMessage("T_IBLOCK_DESC_VACANSY"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "legacy.test.vacansy",
			),
		),
	),
);

?>