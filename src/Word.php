<?php
/**
 * In the name of Allah, the Beneficent, the Merciful.
 *
 * @package		Number to Text Converter
 * @author		Mohammad Amanalikhani <md.akhi.ir@gmail.com>
 * @link			http://docs.akhi.ir/php/NumberToWord/
 * @license		https://www.gnu.org/licenses/agpl-3.0.en.html AGPL-3.0 License
 * @copyright    Copyright (C) 2021 Open Source Matters,Inc. All right reserved.
 * @version		Release: 1.0.0-alpha.2
 */

require_once __DIR__ . "/i18n/en_US.php";
require_once __DIR__ . "/i18n/fa_IR.php";

class NTWord
{
    // Languages
    protected const fa_IR = "fa_IR";
    protected const en_US = "en_US";
    private const CLASS_LANG = "NTW_";

    /**
     *
     * @param   string  $language language word
     * @param   string  $class class language word
     * @return  string
     * @since   1.0.0
     */
    private static function setClassLanguage($language, &$class = false)
    {
        return $class = self::CLASS_LANG . $language;
    }

    /**
     *
     * @param   int  $number numeric
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getDigitOne($number, $language)
    {
        if (!is_int($number)) {
            throw new Exception("The value is not integer");
        }
        self::setClassLanguage($language, $class);
        return $DIGIT = $class::DIGIT_ONE[$number];
    }

    /**
     *
     * @param   int  $number numeric
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getDigitTE($number, $language)
    {
        if (!is_int($number)) {
            throw new Exception("The value is not integer");
        }
        //self::setClassLanguage($language, $class);
        $DIGIT = self::setClassLanguage($language)::Digit_TE[$number];
        return $DIGIT;
    }

    /**
     *
     * @param   int  $number numeric
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getDigitTwo($number, $language)
    {
        if (!is_int($number)) {
            throw new Exception("The value is not integer");
        }
        self::setClassLanguage($language, $class);
        return $DIGIT = $class::DIGIT_TWO[$number];
    }

    /**
     *
     * @param   int  $number numeric
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getDigitThree($number, $language)
    {
        if (!is_int($number)) {
            throw new Exception("The value is not integer");
        }
        self::setClassLanguage($language, $class);
        return $DIGIT = $class::Digit_THREE[$number];
    }

    /**
     *
     * @param   int  $number numeric
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getStep($number, $language)
    {
        if (!is_int($number)) {
            throw new Exception("The value is not integer");
        }
        self::setClassLanguage($language, $class);
        return $STEP = $class::STEPS[$number];
    }
    /**
     *
     * @param   int  $number numeric
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getStepPoint($number, $language)
    {
        if (!is_int($number)) {
            throw new Exception("The value is not integer");
        }
        self::setClassLanguage($language, $class);
        return $STEP = $class::STEPS_POINT[$number];
    }

    /**
     *
     * @param   string  $Symbol
     * @param   string  $language language word
     * @return  string
     * @since   1.0.0
     */
    protected static function getSymbol($Symbol, $language)
    {
        if (!is_string($Symbol)) {
            throw new Exception("The value is not Symbol");
        }
        self::setClassLanguage($language, $class);
        return $SYMBOLS = $class::SYMBOLS[$Symbol];
    }
}
