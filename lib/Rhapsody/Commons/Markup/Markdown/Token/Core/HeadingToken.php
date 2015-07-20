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
namespace Rhapsody\Commons\Markup\Markdown\Token\Core;

use Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface;

/**
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Markup\Markdown\Token\Core
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class HeadingToken implements MarkdownTokenInterface
{

  /**
   * The depth of the heading, e.g. 1 to 6.
   * @var int
   */
  private $depth;

  /**
   * The text associated with the heading.
   * @var int
   */
  private $text;

  public function __construct($text, $depth = 1)
  {
    $this->depth = $depth;
    $this->text = $text;
  }

  public function getDepth()
  {
    return $this->depth;
  }

  public function getText()
  {
    return $this->text;
  }

  /**
   * {@inheritDoc}
   * @see \Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface::getType()
   */
  public function getType()
  {
    return MarkdownTokenInterface::HEADING_TOKEN;
  }

  /**
   * {@inheritDoc}
   * @see \Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface::render()
   */
  public function render()
  {
    // TODO:
  }

}