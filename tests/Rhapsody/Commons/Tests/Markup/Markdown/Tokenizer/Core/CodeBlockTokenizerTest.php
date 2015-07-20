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
namespace Rhapsody\Commons\Tests\Markup\Markdown\Tokenizer\Core;

use Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface;
use Rhapsody\Commons\Markup\Markdown\Tokenizer\Core\CodeBlockTokenizer;

class CodeBlockTokenizerTest extends \PHPUnit_Framework_TestCase
{
  public function testRegex()
  {
    $regex = CodeBlockTokenizer::regex();

    // ** Test for <code> matches...
    $matches = array();
    $result  = preg_match($regex, '    This is code', $matches);
    $this->assertEquals(1, $result, 'CodeBlockTokenizer failed to find valid code block markup.');
    $this->assertEquals('    This is code', $matches[0]);
  }

  public function testEvaluateSingleLineCodeBlock()
  {
    $tokenizer = new CodeBlockTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '    This is code';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::CODE_BLOCK_TOKEN, $tokens[0]->getType());

    $codeblock = $tokens[0];
    $this->assertEquals('This is code', $codeblock->getContent());
  }

  public function testEvaluateMultiLineCodeBlock()
  {
    $tokenizer = new CodeBlockTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = <<<EOF
    Line 1
    Line 2
EOF;
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::CODE_BLOCK_TOKEN, $tokens[0]->getType());

    $codeblock = $tokens[0];
    $expected  = <<<EOF
Line 1
Line 2
EOF;
    $this->assertEquals($expected, $codeblock->getContent());
  }
}
