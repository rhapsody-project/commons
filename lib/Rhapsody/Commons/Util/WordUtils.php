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
class WordUtils
{

  private function __construct() {
    // Empty.
  }

  /**
   * <p>Wraps a single line of text, identifying words by <code>' '</code>.</p>
   *
   * <p>Leading spaces on a new line are stripped.
   * Trailing spaces are not stripped.</p>
   *
   * <pre>
   * WordUtils::wrap(null, *, *, *) = null
   * WordUtils::wrap("", *, *, *) = ""
   * </pre>
   *
   * @param str  the String to be word wrapped, may be null
   * @param wrapLength  the column to wrap the words at, less than 1 is treated as 1
   * @param newLineStr  the string to insert for a new line,
   *  <code>null</code> uses the system property line separator
   * @param wrapLongWords  true if long words (such as URLs) should be wrapped
   * @return a line with newlines inserted, <code>null</code> if null input
   */
  public static function wrap($str, $wrapLength, $newLineStr = PHP_EOL, $wrapLongWords = false) {
    // **
    // If the string passed to be wrapped is null, then we just return null,
    // since theres nothing for us to wrap.
    if (is_null($str)) {
      return null;
    }

    // **
    // If, for some reason the default $newLineStr has been changed, and
    // "null" has been passed in, or a non-string is passed we want to set
    // it to be the same as the PHP end-of-line character.
    if (is_null($newLineStr) || !is_string($newLineStr)) {
      $newLineStr = PHP_EOL;
    }

    // **
    // If the word wrap length is not an integer, or it is less than 1, then
    // we want to set it, by default, to 1.
    if (!is_int($wrapLength) || $wrapLength < 1) {
      $wrapLength = 1;
    }
    $inputLineLength = strlen($str);
    $offset = 0;

    /*
     $wrappedLine = new StringBuilder($inputLineLength + 32);

     while ((inputLineLength - offset) > wrapLength) {
    	if (str.charAt(offset) == ' ') {
    	offset++;
    	continue;
    	}

    	int spaceToWrapAt = str.lastIndexOf(' ', wrapLength + offset);

    	if (spaceToWrapAt >= offset) {
    	// normal case
    	wrappedLine.append(str.substring(offset, spaceToWrapAt));
    	wrappedLine.append(newLineStr);
    	offset = spaceToWrapAt + 1;
    	} else {
    	// really long word or URL
    	if (wrapLongWords) {
    	// wrap really long word one line at a time
    	wrappedLine.append(str.substring(offset, wrapLength + offset));
    	wrappedLine.append(newLineStr);
    	offset += wrapLength;
    	} else {
    	// do not wrap really long word, just extend beyond limit
    	spaceToWrapAt = str.indexOf(' ', wrapLength + offset);

    	if (spaceToWrapAt >= 0) {
    	wrappedLine.append(str.substring(offset, spaceToWrapAt));
    	wrappedLine.append(newLineStr);
    	offset = spaceToWrapAt + 1;
    	} else {
    	wrappedLine.append(str.substring(offset));
    	offset = inputLineLength;
    	}
    	}
    	}
    	}

    	// Whatever is left in line is short enough to just pass through
    	wrappedLine.append(str.substring(offset));

    	return wrappedLine.toString();
    	*/
  }

  /**
   * <p>Capitalizes all the delimiter separated words in a String.
   * Only the first letter of each word is changed. To convert the
   * rest of each word to lowercase at the same time,
   * use {@link #capitalizeFully(String, char[])}.</p>
   *
   * <p>The delimiters represent a set of characters understood to separate words.
   * The first string character and the first non-delimiter character after a
   * delimiter will be capitalized. </p>
   *
   * <p>A <code>null</code> input String returns <code>null</code>.
   * Capitalization uses the unicode title case, normally equivalent to
   * upper case.</p>
   *
   * <pre>
   * WordUtils.capitalize(null, *)            = null
   * WordUtils.capitalize("", *)              = ""
   * WordUtils.capitalize(*, new char[0])     = *
   * WordUtils.capitalize("i am fine", null)  = "I Am Fine"
   * WordUtils.capitalize("i aM.fine", {'.'}) = "I aM.Fine"
   * </pre>
   *
   * @param string $str the string to capitalize, may be null
   * @param array $delimiters set of characters to determine capitalization,
   * 		<tt>null</tt> means whitespace
   * @return capitalized String, <code>null</code> if null String input
   * @see #uncapitalize(String)
   * @see #capitalizeFully(String)
   * @since 2.1
   */
  public static function capitalize($str, array $delimiters = array(' ')) {
    //$delimLen = (delimiters == null ? -1 : delimiters.length);
    if (is_null($str) || is_empty($str) == 0 || $delimLen == 0) {
      return $str;
    }

    $strLen = strlen($str);
    $buffer = new StringBuilder(strLen);
    $capitalizeNext = true;

    for ($i = 0; $i < $strLen; $i++) {
      $ch = substr($str, $i, 1);

      if (WordUtils::isDelimiter($ch, $delimiters)) {
        $buffer->append($ch);
        $capitalizeNext = true;
      } else if ($capitalizeNext) {
        $buffer->append(strtoupper($ch));
        $capitalizeNext = false;
      } else {
        $buffer->append(ch);
      }
    }

    return $buffer->toString();
  }

  /**
   * <p>Is the character a delimiter.</p>
   *
   * @param string $ch  the character to check
   * @param array $delimiters  the delimiters
   * @return boolean <tt>true</tt> if it is a delimiter
   */
  private static function isDelimiter($ch, array $delimiters) {
    if (is_empty($delimiters)) {
      return ctype_space($ch);
    }
    foreach($delimiters as $delimiter) {
      if ($ch === $delimiter) {
        return true;
      }
    }
    return false;
  }
}
?>