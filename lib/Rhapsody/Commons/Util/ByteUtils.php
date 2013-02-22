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
class ByteUtils {

  /**
   * A constant holding the minimum value a <code>byte</code> can
   * have, -2<sup>7</sup>.
   */
  const MIN_VALUE = -128;

  /**
   * A constant holding the maximum value a <code>byte</code> can
   * have, 2<sup>7</sup>-1.
   */
  const MAX_VALUE = 127;

  private final $MODE_DEFAULT = 0;
  private final $MODE_READABLE = 1;
  private final $MODE_ARRAY = 2;

  /**
   * Returns an ASCII string containing
   * the binary representation of the input data .
   */
  function toBinary($string) {
    return self::stringToBinaryInternal($string);
  }

  public static function toByteArray($string) {
    return self::stringToBinaryInternal($string, self::MODE_ARRAY);
  }

  /**
   * @param $string
   * @param $mode
   * @return unknown_type
   */
  private static function stringToBinaryInternal($string, $mode = self::MODE_DEFAULT) {
    $output = false;

    for($a=0; $a < strlen($str); $a++) {
      $dec = ord(substr($str,$a,1));
      $bin = '';
      for($i=7; $i>=0; $i--) {
        if ( $dec >= pow(2, $i) ) {
          $bin .= "1";
          $dec -= pow(2, $i);
        } else {
          $bin .= "0";
        }
      }

      // **
      // If the string-to-binary mode is default (no mode override was passed)
      // than we simply append the converted binary value to the output.
      if ($mode === self::MODE_DEFAULT) {
        $output .= $bin;
      }

      // **
      // Readable mode injects a space after all bytes.
      if ($mode === self::MODE_READABLE) {
        $output .= $bin . " ";
        if ($a+1 >= strlen($string)) {
          $ouput = trim($output);
        }
      }

      // **
      if ($mode === self::MODE_ARRAY) {
        $output[$a] = $bin;
      }
    }
    return $output;
  }
}