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
namespace Rhapsody\Commons\Markup\Markdown\Tokenizer\Core;

use Rhapsody\Commons\Markup\Markdown\Tokenizer\AbstractTokenizer;

class ParagraphTokenizer extends AbstractTokenizer
{

  /**
   * {@inheritDoc}
   * @see \Rhapsody\Commons\Markup\Markdown\Tokenizer\AbstractTokenizer::regex()
   */
  public static function regex()
  {
    $factory = new RegexFactory('/^((?:[^\n]+\n?(?!hr|heading|lheading|blockquote|tag|def))+)\n*/')
      ->replace('/hr/', HorizontalRuleTokenizer::regex())
      ->replace('/lheading/', LineHeadingTokenizer::regex())
      ->replace('/heading/', HeadingTokenizer::regex())
      ->replace('/blockquote/', BlockquoteTokenizer::regex())
      ->replace('/tag/', '<' + TagTokenizer::regex())
      ->replace('/def/', DefinitionTokenizer::regex());
    return $factory->build();
  }

  /**
   * {@inheritDoc}
   * @see \Rhapsody\Commons\Markup\Markdown\Tokenizer\AbstractTokenizer::evaluate()
   */
  public function evaluate(&$subject, $top, $blockquote, $callback)
  {
    $regex = ParagraphTokenizer::regex();
  }

}