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
namespace Rhapsody\Commons\Markup\Markdown\Token;

/**
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Markup\Markdown\Token
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
interface MarkdownTokenInterface
{

  /**
   * The token representing the end of a blockquote.
   * @var string
   */
  const BLOCKQUOTE_END_TOKEN = 'BLOCKQUOTE_END';

  /**
   * The token representing the start of a blockquote.
   * @var string
   */
  const BLOCKQUOTE_START_TOKEN = 'BLOCKQUOTE_START';

  /**
   * The token representing a code block.
   * @var string
   */
  const CODE_BLOCK_TOKEN = 'CODE_BLOCK';

  /**
   * The token representing a heading.
   * @var string
   */
  const HEADING_TOKEN = 'HEADING';

  /**
   * The token representing a link.
   * @var string
   */
  const LINK_TOKEN = 'LINK';

  /**
   * Returns the type name of the token.
   *
   * @return string the type name of the token.
   */
  function getType();

  /**
   * Returns the regular expression that defines the token.
   *
   * @return string the regular expression that defines the token.
   */
  function render();

}
