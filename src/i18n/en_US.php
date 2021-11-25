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

class NTW_en_US
{
	// Languages
	const LANG = "en_US";
	const DIGIT_ONE = [
		"zero",
		"one",
		"two",
		"three",
		"four",
		"five",
		"six",
		"seven",
		"eight",
		"nine",
	];
	const DIGIT_TE = [
		"",
		"eleven",
		"twelve",
		"thirteen",
		"fourteen",
		"fifteen",
		"sixteen",
		"seventeen",
		"eighteen",
		"nineteen",
	];
	const DIGIT_TWO = [
		"",
		"ten",
		"twenty",
		"thirty",
		"forty",
		"fifty",
		"sixty",
		"seventy",
		"eighty",
		"ninety",
	];
	const Digit_THREE = [
		"",
		"one hundred",
		"two hundred",
		"three hundred",
		"four hundred",
		"five hundred",
		"six hundred",
		"seven hundred",
		"eight hundred",
		"nine hundred",
	];
	const STEPS = [
		"",
		"thousand", //	10^3
		"million", //	10^6
		"billion", //	10^9
		"trillion", //	10^12
		"quadrillion", //	10^15
		"quintillion", //	10^18
		"sextillion", //	10^21
		"septillion", //	10^24
		"octillion", //	10^27
		"nonillion", //	10^30
		"decillion", //	10^33
	];
	const STEPS_POINT = [
		"",
		"tenth", // 10^1
		"hundredth", //10^2
		"thousandth", // 10^3
	];
	const SYMBOLS = ["&" => "and", "." => ""];
}
