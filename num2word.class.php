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
class Num2Word
{
	private static $Digit_ON = array(
	"en"=>
	array('zero','one','two','three','four','five','six','seven','eight','nine'),
	"fa"=>
	array('صفر','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه')
	);   
 
	private static $Digit_TE = array(
	"en"=>
	array(1 =>'eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen'),
	"fa"=>
	array(1 =>'یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده')
	);
	
	private static $Digit_TW = array(
	"en"=>
	array(1 =>'ten','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'),
	"fa"=>
	array(1 =>'ده','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود')
	);  
	
	private static $Digit_TH = array(
	"en"=>
	array(1 =>'one hundred','two hundred','three hundred','four hundred','five hundred','six hundred','seven hundred','eight hundred','nine hundred'),
	"fa"=>
	array(1 =>'یکصد','دویست','سیصد','چهارصد','پانصد','ششصد','هفتصد','هشتصد','نهصد')
	);  
	
	private static $Steps_Point = array(
	"en"=>
	array(
		1 =>'tenth', // 10^1
		'hundredth', //10^2
		'thousandth' // 10^3
	),
	"fa"=>
	array(
		1 =>'دهم', // .10^1
		'صدم', // .10^2
		'هزارم' // .10^3
	));
	private static $Steps= array(
	"en"=>
	array(
		1 =>'thousand',	//	10^3
		'million',	//	10^6
		'billion',	//	10^9
		'trillion',	//	10^12
		'quadrillion',	//	10^15
		'quintillion',	//	10^18
		'sextillion',	//	10^21
		'septillion',	//	10^24
		'octillion',	//	10^27
		'nonillion',	//	10^30
		'decillion'	//	10^33
	),
	"fa"=>
	array(
		1 =>'هزار',	//	10^3
		'میلیون',	//	10^6
		'میلیارد',	//	10^9
		'تریلیون',	//	10^12
		'کادریلیون',	//	10^15
		'کوینتریلیون',	//	10^18
		'سکستریلیون',	//	10^21
		'سپتریلیون',	//	10^24
		'اکتریلیون',	//	10^27
		'نونیلیون',	//	10^30
		'دسیلیون'	//	10^33
	)
	);
	
	private static $etc = array(
	"en"=>
	array('&' =>'and','.' =>''),
	"fa"=>
	array('&' =>'و','.' =>'')
	);
  
	protected $Lang,$Decimal_Point;
	public $Result,$Number,$Number_P;
	
	public function __construct($Number,$lang="fa",$Decimal_Point = 1){
		$this->Lang = $lang?:"fa";
		$this->Decimal_Point = ($Decimal_Point < 4) ? $Decimal_Point : 3;
		//print number_format($Number,10).'<br>';
		self::numberToWords($Number);
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
	private function groupToWords($group,$group_point = 0) {
		$group=sprintf('%03d',$group);
		$d1 = (int)$group{2};
		$d2 = (int)$group{1};
		$d3 = (int)$group{0};
		$group_array = array();
		if(!$group_point)
		{
			if ($d3 != 0) 
				$group_array[] = self::$Digit_TH[$this->Lang][$d3];
			if ($d2 == 1 && $d1 != 0) // 11-...-19
				$group_array[] = self::$Digit_TE[$this->Lang][$d1];
			else if ($d2 != 0 && $d1 == 0) // 1-...-9+0
				$group_array[] = self::$Digit_TW[$this->Lang][$d2];
			else if ($d2 == 0 && $d1 == 0){} // 00
			else if ($d2 == 0 && $d1 != 0) // 1-...-9
			{
				$group_array[] = self::$Digit_ON[$this->Lang][$d1];
			} else
			{
				$group_array[] = self::$Digit_TW[$this->Lang][$d2];
				$group_array[] = self::$Digit_ON[$this->Lang][$d1];
			}

		}
		elseif($group_point)
		{
			if ($d3 != 0) 
				$group_array[] = self::$Digit_TH[$this->Lang][$d3];
			if ($d2 == 1 && $d1 != 0) // 11-19
				$group_array[] = self::$Digit_TE[$this->Lang][$d1];
			else if ($d2 != 0 && $d1 == 0) // 10-20-...-90
				$group_array[] = self::$Digit_TW[$this->Lang][$d2];
			else if ($d2 == 0 && $d1 == 0){} // 00
			else if ($d2 == 0 && $d1 != 0) // 1-9
				$group_array[] = self::$Digit_ON[$this->Lang][$d1];
			else // Others
			{
				$group_array[] = self::$Digit_TW[$this->Lang][$d2];
				$group_array[] = self::$Digit_ON[$this->Lang][$d1];
			}
		}
		if (!count($group_array))
			return FALSE;
		return $group_array;
	}

	public function numberToWords($number,$decimal_point=0) {
		list($formated,$point) = explode('.',number_format(preg_replace("/[,]/","",$number),$decimal_point?:$this->Decimal_Point,".", ","));
		$this->Number_P = $formated . (empty($point) ? "" : ".".$point);
		$this->Number = $formated;
		$groups = explode(',', $formated);
		$step_num = count($groups)-1;
		$parts = array();
		foreach($groups as $step => $group)
		{
			$group_words = self::groupToWords($group);
			if($group_words)
			{
				$part = implode(' ' . self::$etc[$this->Lang]['&'] . ' ', $group_words);
				if(isset(self::$Steps[$this->Lang][$step_num - $step])) 
				{
					$part .= ' ' . self::$Steps[$this->Lang][$step_num - $step];
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
				$part_point = implode(' ' . self::$etc[$this->Lang]['&&'] . ' ', $group_words_point);
				if (isset(self::$Steps_Point[$this->Lang][strlen(strrev(strrev($point)+0)) - $step_point])) 
				{
					$part_point .= ' ' . self::$Steps_Point[$this->Lang][strlen(strrev(strrev($point)+0)) - $step_point];
				}
				$parts[] = $part_point;
			}
		} */
		return ($this->Result = implode(' ' . self::$etc[$this->Lang]['&'] . ' ', $parts));
	}
	function show(){
		return $this->Result;
	}
	public function __toString(){
        return $this->Result;
    }
}
