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
namespace Rhapsody\Commons\Lang;

/**
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Lang
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class StringBuilder
{

  /**
   * The buffer array of string values that will later be concatenated together
   * to form a single string.
   * @var array
   * @access private
   */
  private $_content;

  /**
   * Number of spaces to indent prepend to the final string to "left dent" it.
   * @var int
   * @access private
   */
  private $mLeftIndent;


  /**
   * @return StringBuilder
   */
  public function __construct($value = null)
  {
    $this->_content = array();

    if (is_string($value)) {
      $this->append($value);
    }
    return $this;
  }

  public function indent($indent)
  {
    $this->mLeftIndent = $indent;
  }

  public function length()
  {
    $length = 0;
    foreach ($this->_content as $item) {
      $length += strlen($item);
    }
    return $length;
  }

  /**
   * Appends $value to the StringBuilder's internal value array
   * @param mixed $value
   * @return StringBuilder this
   */
  public function append($value)
  {
    $_internalVal = is_object($value) ? $value->__toString() : $value;
    array_push($this->_content, $_internalVal);
    return $this;
  }

  public function clear()
  {
    try {
      $this->_content = null;
      $this->_content = array();
    }
    catch (Exception $ex) {

    }
  }

  /**
   *
   */
  public function __toString()
  {
    $this->toString(false);
  }

  /**
   * Converts the StringBuilder's internal array to a string and returns it, if the
   * variable <tt>$crlf</tt> (Carriage-Return, Line-Feed) is set to true it will
   * append a carriage return and a line feed to the string value.
   *
   * @param boolean $delimit whether or not to delimit the string in the string
   *      buffer or not.
   * @param stirng $delimiter the string to delimit the
   * @return string the string value of the StringBuilder's contents
   */
  public function toString($delimit = false, $delimiter = "\r\n")
  {
    if ($delimit) {
      return implode($delimiter, $this->_content);
    }
    return implode('', $this->_content);
  }
}

?>