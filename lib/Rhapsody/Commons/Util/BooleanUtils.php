<?php
/* Copyright (c) 2013 Rhapsody Project
 *
 * Licensed under the MIT License (http://opensource.org/licenses/MIT)
 *
 * Permission is hereby granted, free of charge, to any
 * person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice
 * shall be included in all copies or substantial portions of
 * the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
 * KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Rhapsody\Commons\Util;

use Rhapsody\Commons\Exception\NullPointerException;

/**
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Util
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class BooleanUtils {

  private static $_trueArray = array('true', 'yes', 'y', 'on', '1', 1, true);
  private static $_falseArray = array('false', 'no', 'n', 'off', '0', 0, false, null);

  private function __construct() {
    // Empty, this is a utility class.
  }

  public static function boolVal($value) {
    $value = is_string($value) ? strtolower($value) : $value;

    // ** If we're in the false array, return FALSE
    if (in_array($value, self::$_falseArray, true)) {
      return false;
    }

    // ** If we're in the true array, return TRUE
    if (in_array($value, self::$_trueArray, true)) {
      return true;
    }

    // ** Default to PHP's handling of the bool value
    return $value ? true : false;
  }

  /**
   *
   * Enter description here...
   * @param $bool
   * @return unknown_type
   */
  public static function isFalse($bool) {
    if (is_bool($bool)) {
      return $bool ? false : true;
    }
    return false;
  }

  /**
   *
   * Enter description here...
   * @param $bool
   * @return unknown_type
   */
  public static function isTrue($bool) {
    if (is_bool($bool)) {
      return $bool ? true : false;
    }
    return false;
  }

  /**
   * <p>Converts a String to a Boolean throwing an exception if no match.</p>
   *
   * <pre>
   *   BooleanUtils.toBooleanObject("true", "true", "false", "null") = true
   *   BooleanUtils.toBooleanObject("false", "true", "false", "null")= false
   *   BooleanUtils.toBooleanObject("null", "true", "false", "null") = null
   * </pre>
   *
   * @param string $str the string to check
   * @param string $trueString the string to match for <code>true</code>
   *    (case sensitive), may be <code>null</code>
   * @param string $falseString the string to match for <code>false</code>
   *    (case sensitive), may be <code>null</code>
   * @param string $nullString the string to match for <code>null</code>
   *    (case sensitive), may be <code>null</code>
   * @return the boolean value of the string, <code>null</code> if no match or
   *    <code>null</code> input
   */
  public static function toBoolean($str, $trueString, $falseString, $nullString = "null") {
    if (is_null($str)) {
      throw new NullPointerException("Unabled to convert <null> string to boolean.");
    }

    if ($str === $trueString) {
      return true;
    }
    else if ($str === $falseString) {
      return false;
    }
    else if ($str === $nullString) {
      return null;
    }

    // no match
    throw new \IllegalArgumentException("The String did not match any specified value");
  }

  /**
   * <p>Converts a Boolean to a String returning one of the input Strings.</p>
   *
   * <pre>
   *   BooleanUtils::toString(true, "true", "false", null) = "true"
   *   BooleanUtils::toString(false, "true", "false", null) = "false"
   *   BooleanUtils::toString(null, "true", "false", null) = null;
   * </pre>
   *
   * @param boolean $bool the Boolean to check
   * @param string $trueString the String to return if <code>true</code>,
   *  may be <code>null</code>
   * @param string $falseString the String to return if <code>false</code>,
   *  may be <code>null</code>
   * @param string $nullString the String to return if <code>null</code>,
   *  may be <code>null</code>
   * @return one of the three input Strings
   */
  public static function toString($bool, $trueString, $falseString, $nullString = "[NULL]") {
    if (is_null($bool) || !is_bool($bool)) {
      return $nullString;
    }
    return $bool ? $trueString : $falseString;
  }
}
?>