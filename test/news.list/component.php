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

/** @global CIntranetToolbar $INTRANET_TOOLBAR */

use Bitrix\Main\Context,
    Bitrix\Main\Loader,
    Bitrix\Main\ORM,
    Bitrix\Iblock;

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["PROPERTY_CODE"] = trim($arParams["PROPERTY_CODE"]);
$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);

if($this->startResultCache()) {
    if (!Loader::includeModule("iblock")) {
        $this->abortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }

    $rsIBlock = \Bitrix\Iblock\IblockTable::getList([
        'select' => ['ID', 'IBLOCK_TYPE_ID', 'NAME', 'API_CODE'],
        'filter' => ["ACTIVE" => "Y", "ID" => $arParams["IBLOCK_ID"]]
    ]);

    $arResult = $rsIBlock->fetch();
    if (!$arResult) {
        $this->abortResultCache();
        return;
    }

    $elementEntity = \Bitrix\Iblock\IblockTable::compileEntity($arResult['API_CODE']);
    $res = (new ORM\Query\Query($elementEntity))
        ->addFilter('ACTIVE', 'Y')
        ->setSelect(['ID', 'NAME', 'PREVIEW_TEXT', 'SECTION_' => 'IBLOCK_SECTION', $arParams['PROPERTY_CODE'].'_' => $arParams['PROPERTY_CODE']])
        ->exec();
    $items = $res->fetchAll();

    $arResult["ITEMS"] = array();

    foreach ($items as $item) {
        $resultItem['ID'] = $item['ID'];
        $resultItem['NAME'] = $item['NAME'];
        $resultItem['PREVIEW_TEXT'] = $item['PREVIEW_TEXT'];
        $resultItem['SECTION'] = $item['SECTION_NAME'];
        $resultItem['DETAIL_URL'] = $arParams['DETAIL_URL']."=".$item['ID'];
        $resultItem[$arParams['PROPERTY_CODE']] = $item[$arParams['PROPERTY_CODE'].'_VALUE'];

        $arButtons = CIBlock::GetPanelButtons(
            $arResult["ID"],
            $item["ID"],
            0,
            array("SECTION_BUTTONS" => false, "SESSID" => false)
        );

        $resultItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $resultItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

        $arResult['ITEMS'][] = $resultItem;

        $this->setResultCacheKeys(array(
            "ID",
            "NAME",
            "SECTION",
            "PREVIEW_TEXT",
            "DETAIL_URL"
        ));
    }
}

$this->includeComponentTemplate();

