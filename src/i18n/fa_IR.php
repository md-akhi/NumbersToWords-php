<?php
/**
 * In the name of Allah, the Beneficent, the Merciful.
 *
 * @package		Number to Text Converter
 * @author		Mohammad Amanalikhani <md.akhi.ir@gmail.com>
 * @link			http://git.akhi.ir/php/NumberToWord/		(Git)
 * @link			http://git.akhi.ir/php/NumberToWord/docs/	(wiki)
 * @license		https://www.gnu.org/licenses/agpl-3.0.en.html AGPL-3.0 License
 * @copyright    Copyright (C) 2021 Open Source Matters,Inc. All right reserved.
 * @version		Release: 1.0.0-alpha.2
 */

class NTW_fa_IR
{
	// Languages
	const LANG = "fa_IR";
	const DIGIT_ONE = [
		"صفر",
		"یک",
		"دو",
		"سه",
		"چهار",
		"پنج",
		"شش",
		"هفت",
		"هشت",
		"نه",
	];
	const DIGIT_TE = [
		"",
		"یازده",
		"دوازده",
		"سیزده",
		"چهارده",
		"پانزده",
		"شانزده",
		"هفده",
		"هجده",
		"نوزده",
	];
	const DIGIT_TWO = [
		"",
		"ده",
		"بیست",
		"سی",
		"چهل",
		"پنجاه",
		"شصت",
		"هفتاد",
		"هشتاد",
		"نود",
	];
	const Digit_THREE = [
		"",
		"یک‌صد",
		"دویست",
		"سیصد",
		"چهارصد",
		"پانصد",
		"شش‌صد",
		"هفت‌صد",
		"هشت‌صد",
		"نه‌صد",
	];
	const STEPS = [
		"",
		"هزار", //	10^3
		"میلیون", //	10^6
		"میلیارد", //	10^9
		"تریلیون", //	10^12
		"کادریلیون", //	10^15
		"کوینتریلیون", //	10^18
		"سکستریلیون", //	10^21
		"سپتریلیون", //	10^24
		"اکتریلیون", //	10^27
		"نونیلیون", //	10^30
		"دسیلیون", //	10^33
	];
	const STEPS_POINT = [
		"",
		"دهم", // .10^1
		"صدم", // .10^2
		"هزارم", // .10^3
	];
	const SYMBOLS = ["&" => "و", "." => ""];
}
