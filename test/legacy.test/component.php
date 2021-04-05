<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$arDefaultVariableAliases = array();
$arComponentVariables = array("ELEMENT_ID");

	CComponentEngine::initComponentVariables(false, $arComponentVariables, $arDefaultVariableAliases, $arVariables);

    $variableAlias = "ELEMENT_ID";

	$componentPage = "";

	if(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
		$componentPage = "detail";
	else
		$componentPage = "list";

	$arResult = array(
		"FOLDER" => "",
		"URL_TEMPLATES" => array(
			"list" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
			"detail" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$variableAlias),
		),
		"VARIABLES" => $arVariables,
	);

$this->includeComponentTemplate($componentPage);