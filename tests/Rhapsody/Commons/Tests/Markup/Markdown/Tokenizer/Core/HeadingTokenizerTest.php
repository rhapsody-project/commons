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
use Rhapsody\Commons\Markup\Markdown\Tokenizer\Core\HeadingTokenizer;

class HeadingTokenizerTest extends \PHPUnit_Framework_TestCase
{

  public function testRegex()
  {
    $regex = HeadingTokenizer::regex();

    // ** Test for <h1> heading matches...
    $matches = array();
    $result  = preg_match($regex, '# Heading 1', $matches);
    $this->assertEquals(1, $result, 'HeadingToken failed to find valid heading markup.');
    $this->assertEquals('# Heading 1', $matches[0]);

    // ** Test for <h2> heading matches...
    $matches = array();
    $result  = preg_match($regex, '## Heading 2', $matches);
    $this->assertEquals(1, $result, 'HeadingToken failed to find valid heading markup.');
    $this->assertEquals('## Heading 2', $matches[0]);

    // ** Test for <h3> heading matches...
    $matches = array();
    $result  = preg_match($regex, '### Heading 3', $matches);
    $this->assertEquals(1, $result, 'HeadingToken failed to find valid heading markup.');
    $this->assertEquals('### Heading 3', $matches[0]);

    // ** Test for <h4> heading matches...
    $matches = array();
    $result  = preg_match($regex, '#### Heading 4', $matches);
    $this->assertEquals(1, $result, 'HeadingToken failed to find valid heading markup.');
    $this->assertEquals('#### Heading 4', $matches[0]);

    // ** Test for <h5> heading matches...
    $matches = array();
    $result  = preg_match($regex, '##### Heading 5', $matches);
    $this->assertEquals(1, $result, 'HeadingToken failed to find valid heading markup.');
    $this->assertEquals('##### Heading 5', $matches[0]);

    // ** Test for <h6> heading matches...
    $matches = array();
    $result  = preg_match($regex, '###### Heading 6', $matches);
    $this->assertEquals(1, $result, 'HeadingToken failed to find valid heading markup.');
    $this->assertEquals('###### Heading 6', $matches[0]);
  }

  public function testEvaluateHeading1()
  {
    $tokenizer = new HeadingTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '# Heading 1';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::HEADING_TOKEN, $tokens[0]->getType());

    $heading = $tokens[0];
    $this->assertEquals(1, $heading->getDepth());
    $this->assertEquals('Heading 1', $heading->getText());
  }

  public function testEvaluateHeading2()
  {
    $tokenizer = new HeadingTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '## Heading 2';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::HEADING_TOKEN, $tokens[0]->getType());

    $heading = $tokens[0];
    $this->assertEquals(2, $heading->getDepth());
    $this->assertEquals('Heading 2', $heading->getText());
  }

  public function testEvaluateHeading3()
  {
    $tokenizer = new HeadingTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '### Heading 3';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::HEADING_TOKEN, $tokens[0]->getType());

    $heading = $tokens[0];
    $this->assertEquals(3, $heading->getDepth());
    $this->assertEquals('Heading 3', $heading->getText());
  }

  public function testEvaluateHeading4()
  {
    $tokenizer = new HeadingTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '#### Heading 4';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::HEADING_TOKEN, $tokens[0]->getType());

    $heading = $tokens[0];
    $this->assertEquals(4, $heading->getDepth());
    $this->assertEquals('Heading 4', $heading->getText());
  }

  public function testEvaluateHeading5()
  {
    $tokenizer = new HeadingTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '##### Heading 5';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::HEADING_TOKEN, $tokens[0]->getType());

    $heading = $tokens[0];
    $this->assertEquals(5, $heading->getDepth());
    $this->assertEquals('Heading 5', $heading->getText());
  }

  public function testEvaluateHeading6()
  {
    $tokenizer = new HeadingTokenizer();
    $callback = function(&$subject, $top, $blockquote) { return array(); };

    $input  = '###### Heading 6';
    $tokens = $tokenizer->evaluate($input, true, false, $callback);

    $this->assertEquals(1, count($tokens));
    $this->assertInstanceOf('Rhapsody\Commons\Markup\Markdown\Token\MarkdownTokenInterface', $tokens[0]);
    $this->assertEquals(MarkdownTokenInterface::HEADING_TOKEN, $tokens[0]->getType());

    $heading = $tokens[0];
    $this->assertEquals(6, $heading->getDepth());
    $this->assertEquals('Heading 6', $heading->getText());
  }
}
