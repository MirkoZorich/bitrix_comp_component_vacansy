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
<div class="news-detail">
	<h2><?=$arResult['NAME']?></h2>
	<p><span>Анонс вакансии: </span><?=$arResult['PREVIEW_TEXT']?></p>
	<p><span>Описание ваканси: </span><?=$arResult['DETAIL_TEXT']?></p>
	<p><span>Из Категории: </span><?=(!empty($arResult['SECTION_NAME']))? $arResult['SECTION_NAME'] : 'Без категории'?></p>
	<p><span>Зарплата: </span><?=$arResult['UF_SALARY_VALUE']?></p>
</div>