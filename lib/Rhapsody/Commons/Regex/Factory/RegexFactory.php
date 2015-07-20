<?php
/* Copyright (c) 2015 Rhapsody Project
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
namespace Rhapsody\Commons\Regex\Factory;

/**
 *
 */
class RegexFactory
{

  /**
   * The array of options.
   * @var array
   */
  private $options = array();

  private $raw;

  /**
   * The regular expression.
   * @var string
   */
  private $regex = '';

  public function __construct($regex, $options = array())
  {
    $this->raw = $regex;
    $this->regex = $regex;
    $this->options = $options;
  }

  public function build()
  {
    return $this->regex;
  }

  public function getOptions()
  {
    return $this->options;
  }

  public function getRaw()
  {
    return $this->raw;
  }

  public function getRegex()
  {
    return $this->regex;
  }

  /**
   * Performs a replace based on a regular expression, against all matches, that
   * will result in the replacement of a given occurrence (the <tt>$name</tt>)
   * with the passed <tt>$value</tt>.
   *
   * @param string $name
   * @param string $value
   */
  public function replace($name, $value)
  {
    $value = preg_replace('/(^|[^\[])\^/', '$1', $value);
    $this->regex = preg_replace($name, $value, $this->regex);

    //if (!$name) return new RegExp(regex, opt);
    //val = val.source || val;
    //val = /*subject*/val.replace(/*pattern*/ /(^|[^\[])\^/g, /*replace*/ '$1');
    //regex = /*subject*/regex.replace(/*pattern*/name, /*repklace*/val);
    return $this;
  }
}
