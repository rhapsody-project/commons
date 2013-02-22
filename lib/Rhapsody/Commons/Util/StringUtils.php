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

/**
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Util
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class StringUtils
{
  /**
   * The empty String <code>""</code>.
   */
  const EMPTY_STRING = "";

  /**
   * <p>
   * Capitalizes a string changing the first letter to title case as per the
   * PHP function <tt>ucfirst</tt>. No other letters are changed.
   * </p>
   *
   * <p>
   * For a word based algorithm, please see the <code>WordUtils</code>
   * method, <tt>capitalize($string)</tt>. A <tt>null</tt> input String
   * returns null.
   * </p>
   *
   * <code>
   * StringUtils::capitalize(null)  = null
   * StringUtils::capitalize("")    = ""
   * StringUtils::capitalize("cat") = "Cat"
   * StringUtils::capitalize("cAt") = "CAt"
   * </code>
   *
   * @param $string
   * @return unknown_type
   */
  public static function capitalize($string)
  {
    if (is_null($string)) {
      return null;
    }
    return ucfirst($string);
  }

  public static function endsWith($check, $string)
  {
    if ($check === "" || $check === $string) {
      return true;
    }
	else {
      return (strpos(strrev($string), strrev($check)) === 0) ? true : false;
    }
  }

  /**
   * @param $string
   * @return unknown_type
   */
  public static function isEmpty($string)
  {
    $string = trim($string);
    if (!is_string($string)) {
      throw new Exception("StringUtils::isEmpty() is designed to only check against "
			. "string values. You passed in a variable of " . gettype($string) . " type.");
    }
    return empty($string);
  }

  /**
   *
   */
  public static function uncapitalize($string)
  {
    if (is_null($string)) {
      return null;
    }
    return lcfirst($string);
  }
}
?>