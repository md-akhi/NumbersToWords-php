<?php
/**
 * In The Name Of God
 * @package Number to Text Converter
 * @author   MohammaD (MD) Amanalikhani
 * @link    http://md-amanalikhani.github.io | http://md.akhi.ir
 * @copyright   Copyright (C) 2015 - 2020 Open Source Matters,Inc. All right reserved.
 * @license http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version Release: 1.0.0
 */
//require_once __DIR__ . "../vendor/autoload.php";
require_once "Word.php";

class NumberToWord extends NTWord
{
	private $language, $Decimal_Point, $Result, $Number, $Number_P;

	public function __construct($Number, $language = "fa_IR", $Decimal_Point = 1)
	{
		$this->setLanguage($language);
		$this->Decimal_Point = $Decimal_Point < 4 ? $Decimal_Point : 3;
		//print number_format($Number,10).'<br>';
		if (is_numeric($Number)) {
			self::numberToWords((string) $Number);
		} else {
			throw new Exception("Invalid Number");
		}
	}
	/*
  private function number_format($number, $decimal_precision = 0, $decimals_separator = '.', $ETChousands_separator = ',') {
    $number = explode('.', str_replace(' ', '', $number));
    $number[0] = str_split(strrev($number[0]), 3);
    $ETCotal_segments = count($number[0]);
    for ($i = 0; $i < $ETCotal_segments; $i++) {
      $number[0][$i] = strrev($number[0][$i]);
    }
    $number[0] = implode($ETChousands_separator, array_reverse($number[0]));
    if (!empty($number[1])) {
      $number[1] = implode($decimals_separator, $number)-round(implode($decimals_separator, $number), $decimal_precision);

    }
    return implode($decimals_separator, $number);
  }
*/
	private function groupToWords($group, $group_point = 0)
	{
		$group = sprintf("%03d", $group);
		$d1 = (int) $group[2];
		$d2 = (int) $group[1];
		$d3 = (int) $group[0];
		$group_array = [];
		if (!$group_point) {
			if ($d3 != 0) {
				$group_array[] = self::getDigitThree($d3, $this->language);
			}
			if ($d2 == 1 && $d1 != 0) {
				// 11-...-19
				$group_array[] = self::getDigitTE($d1, $this->language);
			} elseif ($d2 != 0 && $d1 == 0) {
				// 1-...-9+0
				$group_array[] = self::getDigitTwo($d2, $this->language);
			} elseif ($d2 == 0 && $d1 == 0) {
			}
			// 00
			elseif ($d2 == 0 && $d1 != 0) {
				// 1-...-9
				$group_array[] = self::getDigitOne($d1, $this->language);
			} else {
				$group_array[] = self::getDigitTwo($d2, $this->language);
				$group_array[] = self::getDigitOne($d1, $this->language);
			}
		} elseif ($group_point) {
			if ($d3 != 0) {
				$group_array[] = self::getDigitThree($d3, $this->language);
			}
			if ($d2 == 1 && $d1 != 0) {
				// 11-19
				$group_array[] = self::getDigitTE($d1, $this->language);
			} elseif ($d2 != 0 && $d1 == 0) {
				// 10-20-...-90
				$group_array[] = self::getDigitTwo($d2, $this->language);
			} elseif ($d2 == 0 && $d1 == 0) {
			}
			// 00
			elseif ($d2 == 0 && $d1 != 0) {
				// 1-9
				$group_array[] = self::getDigitOne($d1, $this->language);
			}
			// Others
			else {
				$group_array[] = self::getDigitTwo($d2, $this->language);
				$group_array[] = self::getDigitOne($d1, $this->language);
			}
		}
		if (!count($group_array)) {
			return false;
		}
		return $group_array;
	}

	private function numberToWords($number, $decimal_point = 0)
	{
		list($formated, $point) = explode(
			".",
			number_format(
				preg_replace("/[,]/", "", $number),
				$decimal_point ?: $this->Decimal_Point,
				".",
				","
			)
		);
		$this->Number_P = $formated . (empty($point) ? "" : "." . $point);
		$this->Number = $formated;
		$groups = explode(",", $formated);
		$step_num = count($groups) - 1;
		$parts = [];
		foreach ($groups as $step => $group) {
			$group_words = self::groupToWords($group);
			if ($group_words) {
				$part = implode(
					" " . self::getSymbol("&", $this->language) . " ",
					$group_words
				);
				$getStep = self::getStep($step_num - $step, $this->language);
				if (isset($getStep)) {
					$part .= " " . $getStep;
				}
				$parts[] = $part;
			}
		}

		/* 		$groups_point = explode(',',number_format(strrev(strrev($point)+0)), 0, '.', ',');
		$step_point = count($groups_point)-1;
		foreach ($groups_point as $step_point => $group_point)
		{
			$group_words_point = self::groupToWords($group_point,1);
			if ($group_words_point)
			{
				$part_point = implode(' ' . self::$etc[$this->language]['&&'] . ' ', $group_words_point);
				if (isset(self::$Steps_Point[$this->language][strlen(strrev(strrev($point)+0)) - $step_point]))
				{
					$part_point .= ' ' . self::$Steps_Point[$this->language][strlen(strrev(strrev($point)+0)) - $step_point];
				}
				$parts[] = $part_point;
			}
		} */
		return $this->Result = implode(
			" " . self::getSymbol("&", $this->language) . " ",
			$parts
		);
	}

	/**
	 * set language
	 * @param   string  $language language word
	 * @return  string
	 * @since   1.0.0
	 *
	 */
	public function setLanguage($language)
	{
		if (!is_string($language)) {
			throw new Exception("The value is not string");
		}
		$DEFAULT_LANG = self::fa_IR;
		switch ($language) {
			case self::fa_IR:
			case self::en_US:
				return $this->language = $language;
			default:
				return $this->language = $DEFAULT_LANG;
		}
	}

	/**
	 * get language
	 * @return  string language word
	 * @since   1.0.0
	 *
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * show result
	 * @return  string result
	 * @since   1.0.0
	 *
	 */
	function show()
	{
		return $this->Result;
	}

	/**
	 * show result
	 * @return  string result
	 * @since   1.0.0
	 *
	 */
	public function __toString()
	{
		return $this->Result;
	}
}
