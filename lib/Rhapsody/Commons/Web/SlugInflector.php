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
namespace Rhapsody\Commons\Web;

/**
 * An implementation of an <tt>InflectorInterface</tt> that inflects a value in
 * the form of a URL slug.
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Web
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class SlugInflector implements InflectorInterface
{
  private $instance;

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new SlugInflector();
    }
    return self::$instance;
  }

  /**
   * (non-PHPDoc)
   * @see \Rhapsody\Commons\Lang\InflectorInterface::inflect()
   */
  public function inflect($input)
  {
      // Trim and replace non-letters and digits by a dash.
      $input = trim(preg_replace('~[^\\pL\d]+~u', '-', $input));

      // transliterate
      if (function_exists('iconv')) {
          $input = iconv('utf-8', 'us-ascii//TRANSLIT', $input);
      }
      // convert to all lowercase
      $input = strtolower($text);

      // finally, remove all unwanted characters
      $input = preg_replace('~[^-\w]+~', '', $input);
      return $input ?: "-";
  }

}
