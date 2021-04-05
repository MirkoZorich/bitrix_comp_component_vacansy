<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Context,
	Bitrix\Main\Type\DateTime,
	Bitrix\Main\Loader,
    Bitrix\Main\ORM,
	Bitrix\Iblock;

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["PROPERTY_CODE"] = trim($arParams["PROPERTY_CODE"]);

if($this->startResultCache()) {
    if (!Loader::includeModule("iblock")) {
        $this->abortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }

    $rsIBlock = \Bitrix\Iblock\IblockTable::getList([
        'select' => ['ID', 'NAME', 'API_CODE'],
        'filter' => ["ACTIVE" => "Y", "ID" => $arParams["IBLOCK_ID"]]
    ]);

    $iblock = $rsIBlock->fetch();
    if (!$iblock) {
        $this->abortResultCache();
        return;
    }

    $elementEntity = \Bitrix\Iblock\IblockTable::compileEntity($iblock['API_CODE']);
    $res = (new ORM\Query\Query($elementEntity))
        ->addFilter('ID', $arParams['ELEMENT_ID'])
        ->setSelect(['ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_TEXT', 'SECTION_' => 'IBLOCK_SECTION', $arParams['PROPERTY_CODE'].'_' => $arParams['PROPERTY_CODE']])
        ->exec();
    $item = $res->fetch();

    $arResult['ID'] = $item['ID'];
    $arResult['NAME'] = $item['NAME'];
    $arResult['PREVIEW_TEXT'] = $item['PREVIEW_TEXT'];
    $arResult['DETAIL_TEXT'] = $item['DETAIL_TEXT'];
    $arResult['SECTION_NAME'] = $item['SECTION_NAME'];
    $arResult['UF_SALARY_VALUE'] = $item['UF_SALARY_VALUE'];

    $arButtons = CIBlock::GetPanelButtons(
        $arParams["IBLOCK_ID"],
        $item["ID"],
        0,
        array("SECTION_BUTTONS" => false, "SESSID" => false)
    );

    $arResult["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $arResult["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

    $this->setResultCacheKeys(array(
        "ID",
        "NAME",
        "PREVIEW_TEXT",
        "DETAIL_TEXT",
        "SECTION_NAME",
        "UF_SALARY_VALUE"
    ));
}

$this->includeComponentTemplate();