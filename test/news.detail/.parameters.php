<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => '={$_REQUEST["ID"]}',
            "REFRESH" => "Y",
        ),
        "PROPERTY_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_PROPERTY"),
            "TYPE" => "STRING",
        ),
        "ELEMENT_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CP_BND_ELEMENT_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
    ),
);
