<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"test:news.detail",
	"",
	Array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);?>
